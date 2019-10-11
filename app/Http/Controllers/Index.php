<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use App\Http\Requests\RequestHomePost;
use App\Http\Requests\RequestPersonalInfo;
use App\Http\Requests\RequestYourHome;
use App\Http\Requests\RequestPhoto;
use App\Http\Requests\RequestSoftDeletePhoto;
use App\Http\Requests\RequestMaterialsPost;
use App\Http\Requests\RequestExtrasPost;
use App\Services\OrderService;
use App\Services\UserService;
use App\Exceptions\OrderNotFoundException;


class Index extends Controller
{
    protected $orderService;
    protected $userService;

    public function __construct(
        OrderService $orderService,
        UserService $userService
    ) {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    public function home()
    {
        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['user']
            );

            $userModel = $orderModel->user;
        } catch (OrderNotFoundException $e) {
            $orderModel = null;
            $userModel = null;
        }

        return (
        view(
            'home',
            [
                'order' => $orderModel,
                'user' => $userModel
            ]
        )
        );
    }

    public function homePost(RequestHomePost $request)
    {
        $userData = $request->only('email');
        $orderData = $request->only(
            'bedroom',
            'bathroom',
            'zip_code'
        );
        $userModel = $this->userService->findByEmailOrCreate(
            $userData['email']
        );

        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId')
            );

            $orderModel->update($orderData);
        } catch (OrderNotFoundException $e) {
            $orderModel = $this->orderService->createUserOrder(
                $userModel,
                $orderData
            );

            // Save current orderId to Session
            Session::put('orderId', $orderModel->id);
        }

        return redirect(route('info'));
    }


    public function personalInfo()
    {
        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['user']
            );
        } catch (OrderNotFoundException $e) {
            return redirect(route('home'));
        }

        return view('personal_info', ['order' => $orderModel, 'user' => $orderModel->user]);
    }


    public function personalInfoPost(RequestPersonalInfo $request)
    {
        $userData = $request->only(
            'mobile_phone',
            'first_name',
            'last_name'
        );
        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['user']
            );
        } catch (OrderNotFoundException $e) {
            return redirect(route('home'));
        }

        $orderModel->user->update($userData);

        $orderData = $request->only(
            'cleaning_frequency',
            'cleaning_type',
            'cleaning_date',
            'street_address',
            'apt',
            'city',
            'home_footage',
            'about_us'
        );

        $orderModel->update($orderData);

        $this->orderService->calculateAndSavePrice($orderModel);

        return redirect(route('yourHome'));
    }

    /*
     * Your Home Get
     */
    public function yourHome()
    {
        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['orderDetail']
            );

        } catch (OrderNotFoundException $e) {
            return redirect(route('home'));
        }

        if (!$orderModel->cleaning_frequency) {
            return redirect(route('info'));
        };

//        return view('your_home', ['orderDetail' => $orderModel->orderDetail]);
        return view('your_home', ['orderDetail' => $orderModel]);
    }

    public function yourHomePostPhoto(RequestPhoto $request)
    {
        $orderModel = $this->orderService->findOrFail(
            Session::get('orderId')
        );

        $this->orderService->actionPhoto($request->file('image'), $orderModel);

        return redirect()->back();
    }

    public function softDeleteYouHomePostPhoto(RequestSoftDeletePhoto $request)
    {
        $modelPath = $this->orderService->getModelPath($request->idPhoto);

        if ($modelPath->order_id !== Session::get('orderId')) {
            return  redirect()->back();
        }

        $this->orderService->softDeletePhoto($request->idPhoto);

        return response()->json(true);
    }

    public function yourHomePost(RequestYourHome $request)
    {
        $dataYourHome = $request->only
        (
            'dogs_or_cats',
            'pets_total',
            'adults',
            'children',
            'rate_cleanliness',
            'cleaned_2_months_ago',
            'differently'
        );

        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['orderDetail']
            );
            $this->orderService->checkRelation($orderModel->orderDetail);
            $orderModel->orderDetail->update($dataYourHome);
        } catch (OrderNotFoundException $e) {
            $this->orderService->createOrderDetail(
                $orderModel,
                $dataYourHome
            );
        }

        if ($request->dogs_or_cats == 'none') {
            $request->pets_total = null;
        }

        $this->orderService->calculateAndSavePrice($orderModel);

        return redirect(route('materials'));
    }

    public function materials()
    {
        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['orderDetail']
            );

        } catch (OrderNotFoundException $e) {
            return redirect(route('home'));
        }

        if (!$orderModel->orderDetail) {
            return redirect(route('yourHome'));
        }

        return view('materials', [
            'MaterialsFloor' => $orderModel->orderMaterialsFloor,
            'MaterialsCountertop' => $orderModel->orderMaterialsCountertop,
            'MaterialsDetail' => $orderModel->orderMaterialsDetail,
        ]);
    }

    public function materialsPost(RequestMaterialsPost $request)
    {
        // Request Go Array
        $dataOrderMaterials = $request->toArray();

        // When checkbox is not selected add 0
        $dataOrderMaterials['hardwood'] = $request->has('hardwood') ? 1 : 0;
        $dataOrderMaterials['cork'] = $request->has('cork') ? 1 : 0;
        $dataOrderMaterials['vinyl'] = $request->has('vinyl') ? 1 : 0;
        $dataOrderMaterials['concrete'] = $request->has('concrete') ? 1 : 0;
        $dataOrderMaterials['carpet'] = $request->has('carpet') ? 1 : 0;
        $dataOrderMaterials['natural_stone'] = $request->has('natural_stone') ? 1 : 0;
        $dataOrderMaterials['tile'] = $request->has('tile') ? 1 : 0;
        $dataOrderMaterials['laminate'] = $request->has('laminate') ? 1 : 0;
        $dataOrderMaterials['concrete_c'] = $request->has('concrete_c') ? 1 : 0;
        $dataOrderMaterials['quartz'] = $request->has('quartz') ? 1 : 0;
        $dataOrderMaterials['formica'] = $request->has('formica') ? 1 : 0;
        $dataOrderMaterials['granite'] = $request->has('granite') ? 1 : 0;
        $dataOrderMaterials['marble'] = $request->has('marble') ? 1 : 0;
        $dataOrderMaterials['tile_c'] = $request->has('tile_c') ? 1 : 0;
        $dataOrderMaterials['paper_stone'] = $request->has('paper_stone') ? 1 : 0;
        $dataOrderMaterials['butcher_block'] = $request->has('butcher_block') ? 1 : 0;

        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['orderDetail']
            );

            $this->orderService->checkRelation($orderModel->orderMaterialsDetail);
            $orderModel->orderMaterialsFloor->update($dataOrderMaterials);
            $orderModel->orderMaterialsCountertop->update($dataOrderMaterials);
            $orderModel->orderMaterialsDetail->update($dataOrderMaterials);
        } catch (OrderNotFoundException $e) {
            $this->orderService->createOrderMaterialsDetail(
                $orderModel,
                $dataOrderMaterials
            );
            $this->orderService->createOrderMaterialsFloor(
                $orderModel,
                $dataOrderMaterials
            );
            $this->orderService->createOrderMaterialsCountertop(
                $orderModel,
                $dataOrderMaterials
            );
        }

        $this->orderService->calculateAndSavePrice($orderModel);

        return redirect(route('extras'));
    }

    public function extras()
    {
        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['orderDetail']
            );

        } catch (OrderNotFoundException $e) {
            return redirect(route('home'));
        }

        if (!$orderModel->orderMaterialsDetail) {
            return redirect(route('materials'));
        }

        return view('extras', [
            'orderExtras' => $orderModel->orderExtras,
            'bedroomExtras' => $orderModel->bedroom,
            'bathroomExtras' => $orderModel->bathroom,
            'homeFootageExtras' => $orderModel->home_footage,
            'data' => $orderModel->total_sum
        ]);
    }

    public function extrasPost(RequestExtrasPost $request)
    {
        $dataExtras = $request->toArray();

        // When checkbox is not selected add 0
        $dataExtras['inside_fridge'] = $request->has('inside_fridge') ? 1 : 0;
        $dataExtras['inside_oven'] = $request->has('inside_oven') ? 1 : 0;
        $dataExtras['garage_swept'] = $request->has('garage_swept') ? 1 : 0;
        $dataExtras['blinds_cleaning'] = $request->has('blinds_cleaning') ? 1 : 0;
        $dataExtras['laundry_wash_dry'] = $request->has('laundry_wash_dry') ? 1 : 0;

        try {
            $orderModel = $this->orderService->findOrFail(
                Session::get('orderId'),
                ['orderExtras']
            );

            $this->orderService->checkRelation($orderModel->orderExtras);
            $orderModel->orderExtras->update($dataExtras);
        } catch (OrderNotFoundException $e) {
            $this->orderService->createOrderExtras(
                $orderModel,
                $dataExtras
            );
        }

        // Send User Notification:
        $this->userService->sendOrderShippedEmail(
            $orderModel->user()->first(),
            $orderModel
        );
        dd(1);

        // TODO: remove only Order ID:
        $request->session()->flush();

        return back();
    }
}
