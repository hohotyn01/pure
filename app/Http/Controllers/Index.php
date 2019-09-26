<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Library\OrderPricing;
use App\Http\Requests\RequestHomePost;
use App\Http\Requests\RequestPersonalInfo;
use App\Http\Requests\RequestYourHome;
use App\Http\Requests\RequestMaterialsPost;
use App\Http\Requests\RequestExtrasPost;
use App\Services\OrderService;
use App\Services\UserService;

class Index extends Controller
{
    protected $orderService;
    protected $userService;
    protected $userModel;
    protected $orderModel;

    public function __construct(
        OrderService $orderService,
        UserService $userService
    ) {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    public function home()
    {
        $this->_setCurrentUserAndOrder();

        return view('home', ['order' => $this->orderModel, 'user' => $this->userModel]);
    }


    public function homePost(RequestHomePost $request)
    {
        $this->_setCurrentUserAndOrder();

        $userData = $request->only('email');
        if ($this->userModel) {
            $this->userModel->update($userData);
        } else {
            $this->userModel = $this->userService->findByEmailOrCreate($userData['email']);

            // Save current userId to Session
            Session::put('userId', $this->userModel->id);
        }

        $orderData = $request->only(
            'bedroom',
            'bathroom',
            'zip_code'
        );

        if ($this->orderModel) {
            $this->orderModel->update($orderData);
        } else {
            $this->orderModel = $this->orderService->createUserOrder
            (
                $this->userModel,
                $orderData
            );

            // Save current orderId to Session
            Session::put('orderId', $this->orderModel->id);
        }

        return redirect(route('info'));
    }


    public function personalInfo()
    {
        $this->_setCurrentUserAndOrder();

        return view('personal_info', ['order' => $this->orderModel, 'user' => $this->userModel]);
    }


    public function personalInfoPost(RequestPersonalInfo $request)
    {
        $this->_setCurrentUserAndOrder();

        $userData = $request->only
        (
            'mobile_phone',
            'first_name',
            'last_name'
        );

        if ($this->userModel)
        {
            $this->userModel->update($userData);
        }

        $orderData = $request->only
        (
            'cleaning_frequency',
            'cleaning_type',
            'cleaning_date',
            'street_address',
            'apt',
            'city',
            'home_footage',
            'about_us'
        );

        if($this->orderModel)
        {
            $this->orderModel->update($orderData);

            Session::put('first_name', $this->userModel->first_name);
        }

        $orderPricing = new OrderPricing($this->orderService->find(Session::get('orderId')));
        $this->orderModel->total_sum = $orderPricing->calculate();
        $this->orderModel->save();

        return redirect(route('home'));
    }


    public function yourHome()
    {
        $this->_setCurrentUserAndOrder();

        $orderDetail = $this->orderService->findWithRelation(
            $this->orderModel->id,
            'orderDetail'
        )->orderDetail;

        return view('your_home', ['orderDetail' => $orderDetail]);
    }

    public function yourHomePostPhoto()
    {
        $this->_setCurrentUserAndOrder();

        if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($extension), ['png', 'jpg', 'gif', 'bmp'])) {
                echo '{"status":"error"}';
                exit;
            }

            if (move_uploaded_file($_FILES['upl']['tmp_name'], 'storage/' . $_FILES['upl']['name'])) {

                if (!OrderDetailPhoto::where('photo_path', '=', $_FILES['upl']['name'])->exists()) {
                    $orderDetailPhoto = new OrderDetailPhoto;
                    $orderDetailPhoto->photo_path = $_FILES['upl']['name'];
                    $orderDetailPhoto->order_id = Session::get('orderId');
                    $orderDetailPhoto->save();
                    return response()->json(["status" => "success"], 200);
                }

                return response()->json(["status" => "error"], 200);
            }
        }

        echo '{"status":"error"}';
        exit;
    }

    public function yourHomePost(RequestYourHome $request)
    {
        $this->_setCurrentUserAndOrder();

        if ($request->dogs_or_cats == 'none') { //999
            $request->pets_total = null;        //999
        }

        $orderDetail = (
            $this->orderService->findWithRelation(
                $this->orderModel->id,
                'orderDetail'
            )
                ->orderDetail
        );

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

        if ($orderDetail)
        {
            $this->orderService->updateOrderRelationships(
                $this->orderModel,
                $dataYourHome,
                'orderDetail');

            Session::put('idOrderDetail', $orderDetail->id);
        } else {
            $newOrderDetail = $this->orderService->createOrderRelationships(
                $this->orderModel,
                $dataYourHome,
                'orderDetail'
            );

            Session::put('idOrderDetail', $newOrderDetail->id);
        }

        return redirect(route('materials'));
    }

    public function materials()
    {
        $this->_setCurrentUserAndOrder();


        $MaterialsFloor = $this->orderService->findWithRelation(
            $this->orderModel->id,
            'orderMaterialsFloor'
        )->orderMaterialsFloor;

        $MaterialsCountertop = $this->orderService->findWithRelation(
            $this->orderModel->id,
            'orderMaterialsCountertop'
        )->orderMaterialsCountertop;

        $MaterialsDetail = $this->orderService->findWithRelation(
            $this->orderModel->id,
            'orderMaterialsDetail'
        )->orderMaterialsDetail;


        return view('materials', [
            'MaterialsFloor' => $MaterialsFloor,
            'MaterialsCountertop' => $MaterialsCountertop,
            'MaterialsDetail' => $MaterialsDetail,
        ]);
    }


    public function materialsPost(RequestMaterialsPost $request)
    {
        $this->_setCurrentUserAndOrder();

        $orderMaterialsFloor = $this->orderService->findWithRelation(
            $this->orderModel->id,
            'orderMaterialsFloor'
        )->orderMaterialsFloor;

        $orderMaterialsCountertop = $this->orderService->findWithRelation(
            $this->orderModel->id,
            'orderMaterialsCountertop'
        )->orderMaterialsCountertop;

        $orderMaterialsDetail = $this->orderService->findWithRelation(
            $this->orderModel->id,
            'orderMaterialsDetail'
        )->orderMaterialsDetail;

        $dataMaterials = $this->orderService->refactoringRequestDataMaterials($request->toArray());


        if ($orderMaterialsDetail) {
            $this->orderService->updateOrderDetail(
                $this->orderModel,
                $dataMaterials['dataDetail'],
                'orderMaterialsDetail');
            if ($orderMaterialsFloor || $orderMaterialsCountertop)

            dd('Update');
        } else {
            $this->orderService->createOrderDetail(
                $this->orderModel,
                $dataMaterials['dataDetail'],
                'orderMaterialsDetail'
            );

            dd('Create');
        }




        $id = Session::get('orderId');

        $dataCountertops['order_id'] = $id;


        $order = $this->orderService->find($id);
        $orderPricing = new OrderPricing($order);

        $order->per_cleaning = $orderPricing->calculate();
        $order->save();


        //Add DataBase
        OrderMaterialsDetail::updateOrCreate(["order_id" => $id], $data);
        OrderMaterialsFloor::updateOrCreate(["order_id" => $id], $data);
        OrderMaterialsCountertop::updateOrCreate(["order_id" => $id], $dataCountertops);


        /*
         * Add Session
         */
        $idMaterialsDetail = OrderMaterialsDetail::where('order_id', $id)->first()->id;
        $idMaterialsFloor = OrderMaterialsFloor::where('order_id', $id)->first()->id;
        $idMaterialsCountertop = OrderMaterialsCountertop::where('order_id', $id)->first()->id;

        Session::put('idMaterialsDetail', $idMaterialsDetail);
        Session::put('idMaterialsFloor', $idMaterialsFloor);
        Session::put('idMaterialsCountertop', $idMaterialsCountertop);
        /*
         * Add Session
         */

        return redirect(route('extras'));
    }

    public function extras()
    {
        $this->_setCurrentUserAndOrder();

        //If (isset Session ('idOrderExtras'))  get id OrderExtras
        $bedroomExtras = $this->orderService->findOrderBedroom(Session::get('orderId'));
        $bathroomExtras = $this->orderService->findOrderBathroom(Session::get('orderId'));
        $homeFootageExtras = $this->orderService->find(Session::get('orderId'))->home_footage;
        $orderExtras = Session::has('idOrderExtras')
            ? OrderExtras::where('id', Session::get('idOrderExtras'))->first()
            : null;

        $orderPricing = new OrderPricing($this->orderService->find(Session::get('orderId')));
        $data = $orderPricing->calculate();

        return view('extras', [
            'orderExtras' => $orderExtras,
            'bedroomExtras' => $bedroomExtras,
            'bathroomExtras' => $bathroomExtras,
            'homeFootageExtras' => $homeFootageExtras,
            'data' => $data
        ]);
    }


    public function extrasPost(RequestExtrasPost $request)
    {
        $this->_setCurrentUserAndOrder();

        $id = Session::get('orderId');
        $data = $request->toArray();

        // When checkbox is not selected add 0
        $data['inside_fridge'] = $request->has('inside_fridge') ? 1 : 0;
        $data['inside_oven'] = $request->has('inside_oven') ? 1 : 0;
        $data['garage_swept'] = $request->has('garage_swept') ? 1 : 0;
        $data['blinds_cleaning'] = $request->has('blinds_cleaning') ? 1 : 0;
        $data['laundry_wash_dry'] = $request->has('laundry_wash_dry') ? 1 : 0;

        // Add DataBase
        OrderExtras::updateOrCreate(["order_id" => $id], $data);

        $order = $this->orderService->findWithRelation($id, 'decryptionType');

        // Get calculate sum
        $orderPricing = new OrderPricing($order);
        $order->total_sum = $orderPricing->calculate();
        $order->save();

        $user = $this->userService->find($order->user_id);

        // Send mail
        Mail::to('vasa@gmail.com')->send(new OrderShipped($order, $user));
        dd(1);
        $request->session()->flush();

        return back();
    }

    public function _setCurrentUserAndOrder()
    {
        $this->userModel =
            (
            Session::has('userId')
                ? $this->userService->find(Session::get('userId'))
                : null
            );
        $this->orderModel =
            (
            Session::has('orderId')
                ? $this->orderService->find(Session::get('orderId'))
                : null
            );
    }
}
