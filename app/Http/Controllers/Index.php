<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\DB;
    use Session;
    use Validator;
    use Illuminate\Http\Request;
    use App\Models\Order;
    use App\Models\OrderDetail;
    use App\Models\OrderDetailPhoto;
    use App\Models\OrderExtras;
    use App\Models\OrderMaterialsCountertop;
    use App\Models\OrderMaterialsDetail;
    use App\Models\OrderMaterialsFloor;
    use App\Models\User;

    class Index extends Controller
    {
        public function home(Request $request)
        {

            if ($request->isMethod('get')) {
                if (Session::has('userId') && Session::has('orderId')) {
                    $order = Order::where('id', Session::get('orderId'))->get();
                    $user = User::where('id', Session::get('userId'))->get();

                    return view('home', ['order' => $order, 'user' => $user]);
                } else {
                    return view('home');
                }
            }

            if ($request->isMethod('post')) {
                /*
                 * Validate Start
                 */
                $validator = Validator::make($request->all(), [
                    'bedroom' => 'required|in:1,2,3,4,5,6,7,8,9,10',
                    'bathroom' => 'required|in:1,1.5,2,2.5,3,3.5,4,4.5,5',
                    'zip_code' => 'required|max:10',
                    'email' => 'required|email|max:150',
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }
                /*
                 * Validate End
                 */

                /*
                * Save start
                */
                $dataUser = $request->except(
                    'user_id',
                    '_token',
                    'bedroom',
                    'zip_code',
                    'bathroom'
                );

                //Add User in Database
                User::updateOrcreate($dataUser);

                //Add Session userId
                $user = User::where('email', $dataUser)->first()->id;
                Session::put('userId', "$user");


                //Add Order in Database
                $idUser = Session::get('userId');
                $dataOrder = $request->except('email', '_token');
                $dataOrder['user_id'] = $idUser;

                Order::updateOrCreate($dataOrder);

                //Add Session orderId
                $order = Order::where('user_id', $user)->first()->id;
                Session::put('orderId', $order);

                return redirect(route('info'));
                /*
                 * Save end
                 */
            }
        }

        public function personalInfo(Request $request)
        {
            if ($request->isMethod('get')) {

                if (Session::has('cleaning_frequency') && Session::has('first_name')) {
                    $order = Order::where('id', Session::get('orderId'))->get();
                    $user = User::where('id', Session::get('userId'))->get();

                    return view('personal_info', ['order' => $order, 'user' => $user]);
                } else {
                    return view('personal_info');
                }

            }

            if ($request->isMethod('post')) {
                /*
                * Validate Start
                */
                $validator = Validator::make($request->all(), [
                    'cleaning_frequency' => 'required|in:once,weekly,biweekly,monthly',
                    'cleaning_type' => 'required|in:deep_or_spring,move_in,move_out,post_remodeling',
                    'cleaning_date' => 'required|in:next_available,this_week,next_week,this_month,i_am_flexible,just_need_a_quote',
                    'first_name' => 'required|max:150',
                    'last_name' => 'required|max:150',
                    'street_address' => 'required|max:150',
                    'apt' => 'max:15',
                    'city' => 'required|max:150',
                    'home_footage' => 'required|max:10',
                    'mobile_phone' => 'required|between:9,15',
                    'about_us' => 'required|in:cleaning_for_reason'
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }
                /*
                 * Validate End
                 */

                /*
                * Save start
                */
                $dataOrder = $request->except(
                    '_token',
                    'first_name',
                    'last_name',
                    'mobile_phone'
                );
                $dataUser = $request->except(
                    '_token',
                    'cleaning_frequency',
                    'cleaning_type',
                    'cleaning_date',
                    'street_address',
                    'apt',
                    'city',
                    'home_footage',
                    'about_us'
                );

                //Update Database Order and User
                Order::where('id', Session::get('orderId'))->update($dataOrder);
                User::where('id', Session::get('userId'))->update($dataUser);

                $cleaning_frequency = Order::where('id', Session::get('orderId'))->first()->cleaning_frequency;
                $first_name = User::where('id', Session::get('userId'))->first()->first_name;

                if (!empty($cleaning_frequency) && !empty($first_name)) {
                    Session::put('cleaning_frequency', $cleaning_frequency);
                    Session::put('first_name', $first_name);
                }

                return redirect(route('home'));

                /*
                * Save End
                */
            }
        }

        public function yourHome(Request $request)
        {
            if ($request->isMethod('get')) {

                if (Session::has('idOrderDetail')) {
                    $orderDetails = OrderDetail::where('id', Session::get('idOrderDetail'))->get();

                    if (!empty(Session::get('idOrderPath'))) {
                        $orderPath = OrderDetailPhoto::where('id', Session::get('idOrderPath'))->get();

                        return view('your_home', ['orderDetails' => $orderDetails, 'orderPath' => $orderPath]);
                    } else {
                        return view('your_home', ['orderDetails' => $orderDetails]);
                    }

                } else {
                    return view('your_home');
                }
            }

            if ($request->isMethod('post')) {
                /*
                * Validate Start
                */
                $validator = Validator::make($request->all(), [
                    'dogs_or_cats' => 'required|in:none,dog,cat,both',
                    'pets_total' => 'required|in:pet_1,pet_2,pet_3_more',
                    'adults' => 'required|in:none,1_2,3_4,5_and_more',
                    'children' => 'required|in:none_children,1,2,3_and_more',
                    'rate_cleanliness' => 'required|in:1,2,3,4,5,6,7,8,9,10',
                    'cleaned_2_months_ago' => 'required|in:yes,no',
                    'differently' => 'required|max:255',
                    'photo' => 'max:255|',
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }
                /*
                * Validate End
                */
                /*
                * Save Start
                */
                $id = session::get('orderId');
                $data = $request->except('_token', 'photo');
                $data['order_id'] = $id;

                $dataPhoto = $request->except(
                    '_token',
                    'differently',
                    'cleaned_2_months_ago',
                    'children',
                    'adults',
                    'pets_total',
                    'dogs_or_cats'
                );

                OrderDetail::updateOrCreate(["order_id" => $id], $data);


//                OrderDetailPhoto::updateOrCreate(["order_id"=>$id], $dataPhoto);

//                if(!empty()){
//                    $idOrderPath = OrderDetailPhoto::where('order_id', session::get('orderId'))->first()->id;
//
//                    Session::put('idOrderPath', $idOrderPath);
//                }

                $idOrderDetail = OrderDetail::where('order_id', session::get('orderId'))->first()->id;

                Session::put('idOrderDetail', $idOrderDetail);


                return redirect(route('materials'));
                /*
                * Save End
                */
            }
        }

        public function materials(Request $request)
        {
            if ($request->isMethod('get')) {
//                if (session::has('order') && session::has('user')) {
//
//                }

                return view('materials');
            }

            if ($request->isMethod('post')) {
                /*
                 * Validate Start
                 */
                $validator = Validator::make($request->all(), [
//                    Floor
                    'hardwood' => 'boolean',
                    'cork' => 'boolean',
                    'vinyl' => 'boolean',
                    'concrete' => 'boolean',
                    'carpet' => 'boolean',
                    'natural_stone' => 'boolean',
                    'tile' => 'boolean',
                    'laminate' => 'boolean',
//                    Floor
//                    Countertop
                    'concrete_c' => 'boolean',
                    'quartz' => 'boolean',
                    'formica' => 'boolean',
                    'granite' => 'boolean',
                    'marble' => 'boolean',
                    'tile_c' => 'boolean',
                    'paper_stone' => 'boolean',
                    'butcher_block' => 'boolean',
//                    Countertop
//                    Detail
                    'stainless_steel_appliances' => 'required|in:1,0',
                    'stove_type' => 'required|in:yes,no',
                    'shawer_doors_glass' => 'required|in:yes,no',
                    'mold' => 'required|in:yes,no',
                    'areas_special_attention' => 'max:255',
                    'anything_know' => 'max:255',
//                    Detail
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }
                /*
                * Validate End
                */
                /*
                * Save Start
                */
                $id = session::get('orderId');
                $dataDetails = $request->except(
                    '_token',
                    //countertops
                    'concrete_c',
                    'quartz',
                    'formica',
                    'granite',
                    'marble',
                    'tile_c',
                    'paper_stone',
                    'butcher_block',
                    //floors
                    'hardwood',
                    'cork',
                    'vinyl',
                    'concrete',
                    'carpet',
                    'natural_stone',
                    'tile',
                    'laminate'
                );

                OrderMaterialsDetail::updateOrCreate(["order_id" => $id], $dataDetails);

                $dataFloors = $request->except(
                    '_token',
                    'stainless_steel_appliances',
                    'stove_type',
                    'shawer_doors_glass',
                    'mold',
                    'areas_special_attention',
                    'anything_know',

                    //countertops
                    'concrete_c',
                    'quartz',
                    'formica',
                    'granite',
                    'marble',
                    'tile_c',
                    'paper_stone',
                    'butcher_block'
                );

                OrderMaterialsFloor::updateOrCreate(["order_id" => $id], $dataFloors);

                $dataCountertops = $request->except(
                    '_token',
                    'stainless_steel_appliances',
                    'stove_type',
                    'shawer_doors_glass',
                    'mold',
                    'areas_special_attention',
                    'anything_know',

                    //floors
                    'hardwood',
                    'cork',
                    'vinyl',
                    'concrete',
                    'carpet',
                    'natural_stone',
                    'tile',
                    'laminate'
                );

                OrderMaterialsCountertop::updateOrCreate(["order_id" => $id], $dataCountertops);

                return redirect(route('extras'));
                /*
                * Save End
                */
            }
        }

        public function extras(Request $request)
        {
            if ($request->isMethod('get')) {
                return view('extras');
            }

            if ($request->isMethod('post')) {
                /*
                * Validate Start
                */
                $validator = Validator::make($request->all(), [
//                    Select extras
                    'inside_fridge' => 'boolean',
                    'inside_oven' => 'boolean',
                    'garage_swept' => 'boolean',
                    'blinds_cleaning' => 'boolean',
                    'laundry_wash_dry' => 'boolean',

                    'service_weekend' => 'required|in:yes,no',
                    'carpet' => 'required|in:yes,no',
                ]);

                if ($validator->fails()) {
                    return back()
                        ->withErrors($validator)
                        ->withInput();
                }
                /*
                * Validate End
                */
                /*
                * Save Start
                */
                $OrderExtras = new OrderExtras;

                $OrderExtras->inside_fridge = $request->inside_fridge;
                $OrderExtras->inside_oven = $request->inside_oven;
                $OrderExtras->garage_swept = $request->garage_swept;
                $OrderExtras->blinds_cleaning = $request->blinds_cleaning;
                $OrderExtras->laundry_wash_dry = $request->laundry_wash_dry;
                $OrderExtras->service_weekend = $request->service_weekend;
                $OrderExtras->carpet = $request->carpet;

                if (!$OrderExtras->save()) {
                    abort('404');
                }

                return back();
                /*
                * Save End
                */
            }
        }
    }
