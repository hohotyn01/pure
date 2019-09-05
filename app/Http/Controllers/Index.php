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

        public function home()
        {
            //If (isset Session ('userId')('orderId'))  get id User Order
            $user = Session::has('userId') ? User::where('id', Session::get('userId'))->first() : null;
            $order = Session::has('orderId') ? Order::where('id', Session::get('orderId'))->first() : null;

            return view('home', ['order' => $order, 'user' => $user]);
        }


        public function homePost(Request $request)
        {
            /*
             * Validate Start
             */
            $validator = Validator::make($request->all(), [
                'bedroom' => 'required|max:10',
                'bathroom' => 'required|max:5',
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

            $bedroom = Order::where('user_id', $user)->first()->bedroom;
            $bathroom = Order::where('user_id', $user)->first()->bathroom;

            Session::put('bedroomExtras', $bedroom);
            Session::put('bathroomExtras', $bathroom);

            return redirect(route('info'));
            /*
             * Save end
             */
        }


        public function personalInfo()
        {
            //If (isset Session ('userId')(orderId))  get id User, Order
            $user = Session::has('userId') ? User::where('id', Session::get('userId'))->first() : null;
            $order = Session::has('orderId') ? Order::where('id', Session::get('orderId'))->first() : null;

            return view('personal_info', ['order' => $order, 'user' => $user]);
        }


        public function personalInfoPost(Request $request)
        {
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
                'home_footage' => 'required|max:4',
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

            $first_name = User::where('id', Session::get('userId'))->first()->first_name;
            $homeFootageExtras = Order::where('id', Session::get('orderId'))->first()->home_footage;

            Session::put('first_name', $first_name);
            Session::put('homeFootageExtras', $homeFootageExtras);

            return redirect(route('home'));

            /*
            * Save End
            */

        }


        public function yourHome()
        {
            //If (isset Session ('idOrderDetail'))  get id OrderDetail
            $orderDetails = Session::has('idOrderDetail') ? OrderDetail::where('id',
                Session::get('idOrderDetail'))->first() : null;

            return view('your_home', ['orderDetails' => $orderDetails]);
        }


        public function yourHomePost(Request $request)
        {
            /*
            * Validate Start
            */
            $validator = Validator::make($request->all(), [
                'dogs_or_cats' => 'required|in:none,dog,cat,both',
                'pets_total' => 'required|in:pet_1,pet_2,pet_3_more',
                'adults' => 'required|in:none,1_2,3_4,5_and_more',
                'children' => 'required|in:none_children,1,2,3_and_more',
                'rate_cleanliness' => 'required|max:10',
                'cleaned_2_months_ago' => 'required|in:yes,no',
                'differently' => 'required|max:255',
                'photo.*' => 'image|mimes:jpeg,png,jpg',
                'photo' => 'max:8',
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
            $id = Session::get('orderId');
            $data = $request->except('_token', 'photo');
            $data['order_id'] = $id;

            OrderDetail::updateOrCreate(["order_id" => $id], $data);

            if (!empty($request->file('photo'))) {
                foreach ($request->file('photo') as $photo) {
                    $filename = $photo->hashName();
                    $photo->store('upload', 'public');

                    $orderDetailPhoto = new OrderDetailPhoto;
                    $orderDetailPhoto->photo_path = $filename;
                    $orderDetailPhoto->order_id = $id;
                    $orderDetailPhoto->save();
                }
            }

            $idOrderDetail = OrderDetail::where('order_id', $id)->first()->id;

            Session::put('idOrderDetail', $idOrderDetail);


            return redirect(route('materials'));
            /*
            * Save End
            */
        }


        public function materials()
        {
            //If (isset Session ('idMaterialsCountertop')('idMaterialsFloor')('idMaterialsDetail'))  get id OrderMaterialsFloor OrderMaterialsCountertop OrderMaterialsDetail
            $MaterialsFloor = session::has('idMaterialsFloor') ? OrderMaterialsFloor::where('id',
                session::get('idMaterialsFloor'))->first() : null;
            $MaterialsCountertop = session::has('idMaterialsCountertop') ? OrderMaterialsCountertop::where('id',
                session::get('idMaterialsCountertop'))->first() : null;
            $MaterialsDetail = session::has('idMaterialsDetail') ? OrderMaterialsDetail::where('id',
                session::get('idMaterialsDetail'))->first() : null;

            return view('materials', [
                'MaterialsFloor' => $MaterialsFloor,
                'MaterialsCountertop' => $MaterialsCountertop,
                'MaterialsDetail' => $MaterialsDetail,
            ]);
        }


        public function materialsPost(Request $request)
        {
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
                'stainless_steel_appliances' => 'required|in:yes,no',
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
            //Request Array
            $data = $request->toArray();
            $dataCountertops = $request->toArray();

            //When checkbox is not selected add 0
            $data['hardwood'] = $request->has('hardwood') ? 1 : 0;
            $data['cork'] = $request->has('cork') ? 1 : 0;
            $data['vinyl'] = $request->has('vinyl') ? 1 : 0;
            $data['concrete'] = $request->has('concrete') ? 1 : 0;
            $data['carpet'] = $request->has('carpet') ? 1 : 0;
            $data['natural_stone'] = $request->has('natural_stone') ? 1 : 0;
            $data['tile'] = $request->has('tile') ? 1 : 0;
            $data['laminate'] = $request->has('laminate') ? 1 : 0;

            //When checkbox is not selected add 0
            $dataCountertops['concrete_c'] = $request->has('concrete_c') ? 1 : 0;
            $dataCountertops['quartz'] = $request->has('quartz') ? 1 : 0;
            $dataCountertops['formica'] = $request->has('formica') ? 1 : 0;
            $dataCountertops['granite'] = $request->has('granite') ? 1 : 0;
            $dataCountertops['marble'] = $request->has('marble') ? 1 : 0;
            $dataCountertops['tile_c'] = $request->has('tile_c') ? 1 : 0;
            $dataCountertops['paper_stone'] = $request->has('paper_stone') ? 1 : 0;
            $dataCountertops['butcher_block'] = $request->has('butcher_block') ? 1 : 0;

            $id = Session::get('orderId');

            $dataCountertops['order_id'] = $id;

            //Add DataBase
            OrderMaterialsDetail::updateOrCreate(["order_id" => $id], $data);
            OrderMaterialsFloor::updateOrCreate(["order_id" => $id], $data);
            OrderMaterialsCountertop::updateOrCreate(["order_id" => $id], $dataCountertops);

            $idMaterialsDetail = OrderMaterialsDetail::where('order_id', $id)->first()->id;
            $idMaterialsFloor = OrderMaterialsFloor::where('order_id', $id)->first()->id;
            $idMaterialsCountertop = OrderMaterialsCountertop::where('order_id', $id)->first()->id;

            //Add Session
            Session::put('idMaterialsDetail', $idMaterialsDetail);
            Session::put('idMaterialsFloor', $idMaterialsFloor);
            Session::put('idMaterialsCountertop', $idMaterialsCountertop);

            return redirect(route('extras'));
            /*
            * Save End
            */

        }


        public function extras()
        {
            //If (isset Session ('idOrderExtras'))  get id OrderExtras
            $bedroomExtras = Session::get('bedroomExtras');
            $bathroomExtras = Session::get('bathroomExtras');
            $homeFootageExtras = Session::get('homeFootageExtras');
            $orderExtras = Session::has('idOrderExtras') ? OrderExtras::where('id',
                Session::get('idOrderExtras'))->first() : null;

            return view('extras', [
                'orderExtras' => $orderExtras,
                'bedroomExtras' => $bedroomExtras,
                'bathroomExtras' => $bathroomExtras,
                'homeFootageExtras' => $homeFootageExtras
            ]);
        }


        public function extrasPost(Request $request)
        {
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
            $id = Session::get('orderId');
            $data = $request->toArray();

            //When checkbox is not selected add 0
            $data['inside_fridge'] = $request->has('inside_fridge') ? 1 : 0;
            $data['inside_oven'] = $request->has('inside_oven') ? 1 : 0;
            $data['garage_swept'] = $request->has('garage_swept') ? 1 : 0;
            $data['blinds_cleaning'] = $request->has('blinds_cleaning') ? 1 : 0;
            $data['laundry_wash_dry'] = $request->has('laundry_wash_dry') ? 1 : 0;

            //Add DataBase
            OrderExtras::updateOrCreate(["order_id" => $id], $data);

            //Add Session
            $idOrderExtras = OrderExtras::where('order_id', $id)->first()->id;
            Session::put('idOrderExtras', $idOrderExtras);

            $request->session()->flush();

            return back();
            /*
            * Save End
            */
        }
    }
