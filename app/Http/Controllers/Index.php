<?php

    namespace App\Http\Controllers;

    use http\Env\Response;
    use Session;
    use Validator;
    use Illuminate\Http\Request;
    // Mail Facade
    use Illuminate\Support\Facades\Mail;
    // Mail Model
    use App\Mail\OrderShipped;
    // Models
    use App\Models\Order;
    use App\Models\OrderDetail;
    use App\Models\OrderDetailPhoto;
    use App\Models\OrderExtras;
    use App\Models\OrderMaterialsCountertop;
    use App\Models\OrderMaterialsDetail;
    use App\Models\OrderMaterialsFloor;
    use App\Models\User;
    use App\Models\Calculate;
    use App\Models\DecryptionType;
    use App\Library\OrderPricing;
    // Requests
    use App\Http\Requests\RequestHomePost;
    use App\Http\Requests\RequestPersonalInfo;
    use App\Http\Requests\RequestYourHome;
    use App\Http\Requests\RequestMaterialsPost;
    use App\Http\Requests\RequestExtrasPost;


    class Index extends Controller
    {
        public function home()
        {
            //If (isset Session ('userId')('orderId'))  get id User Order
            $user = Session::has('userId') ? User::where('id', Session::get('userId'))->first() : null;
            $order = Session::has('orderId') ? Order::where('id', Session::get('orderId'))->first() : null;

            return view('home', ['order' => $order, 'user' => $user]);
        }


        public function homePost(RequestHomePost $request)
        {
            $dataUser = $request->only('email');

            //Add User in Database
            $user = User::firstOrCreate($dataUser);

            //Add Session userId
            Session::put('userId', $user->id);


            //Add Order in Database
            $dataOrder = $request->except('email', '_token');
            $dataOrder['user_id'] = Session::get('userId');

            //Save
            $order = Order::updateOrCreate(['id' => Session::get('orderId'), 'user_id' => Session::get('userId')],
                $dataOrder);

            Session::put('orderId', $order->id);
            Session::put('bedroomExtras', $order->bedroom);
            Session::put('bathroomExtras', $order->bathroom);

            return redirect(route('info'));

        }


        public function personalInfo()
        {
            //If (isset Session ('userId')(orderId))  get id User, Order
            $user = Session::has('userId') ? User::find(Session::get('userId')) : null;
            $order = Session::has('orderId') ? Order::find(Session::get('orderId')) : null;
            $session = Session::get('orderId');
            return view('personal_info', ['order' => $order, 'user' => $user, 'session' => $session]);
        }


        public function personalInfoPost(RequestPersonalInfo $request)
        {
            $dataOrder = $request->except(
                '_token'

            );
            $dataUser = $request->except(
                '_token'
            );

            //Update Database Order and User
            $orderModel  = Order::updateOrCreate(['id' => Session::get('orderId')], $dataOrder);
            User::updateOrCreate(['id' => Session::get('userId')], $dataUser);

            $orderPricing = new OrderPricing(Order::find(Session::get('orderId')));
            $orderModel->total_sum = $orderPricing->calculate();
            $orderModel->save();

            $first_name = User::where('id', Session::get('userId'))->first()->first_name;
            $homeFootageExtras = Order::where('id', Session::get('orderId'))->first()->home_footage;

            Session::put('first_name', $first_name);
            Session::put('homeFootageExtras', $homeFootageExtras);

            return redirect(route('home'));

        }


        public function yourHome()
        {
            //If (isset Session ('idOrderDetail'))  get id OrderDetail
            $orderDetails = Session::has('idOrderDetail') ? OrderDetail::where('id',
                Session::get('idOrderDetail'))->first() : null;

            return view('your_home', ['orderDetails' => $orderDetails]);
        }

        public function yourHomePostPhoto(){

            if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

                $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

                if(!in_array(strtolower($extension), ['png', 'jpg', 'gif', 'bmp'])){
                    echo '{"status":"error"}';
                    exit;
                }

                if(move_uploaded_file($_FILES['upl']['tmp_name'], 'storage/'.$_FILES['upl']['name'])){

                    if ( !OrderDetailPhoto::where('photo_path', '=', $_FILES['upl']['name'])->exists() ){
                        $orderDetailPhoto = new OrderDetailPhoto;
                        $orderDetailPhoto->photo_path = $_FILES['upl']['name'];
                        $orderDetailPhoto->order_id = Session::get('orderId');
                        $orderDetailPhoto->save();
                        return response()->json(["status"=>"success"], 200) ;
                    }

                    return response()->json(["status"=>"error"], 200) ;
                }
            }

            echo '{"status":"error"}';
            exit;
        }

        public function yourHomePost(RequestYourHome $request)
        {
            if($request->dogs_or_cats == 'none'){
                $request->pets_total = null;
            }
            $id = Session::get('orderId');
            $data = $request->except('_token', 'photo');
            $data['order_id'] = $id;

            OrderDetail::updateOrCreate(["order_id" => $id], $data);

            $idOrderDetail = OrderDetail::where('order_id', $id)->first()->id;

//            $orderPricing = new OrderPricing());
//            $orderModel->total_sum = $orderPricing->calculate();
//            $orderModel->save();

            Session::put('idOrderDetail', $idOrderDetail);

            return redirect(route('materials'));

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


        public function materialsPost(RequestMaterialsPost $request)
        {
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


            $order = Order::find($id);
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
            //If (isset Session ('idOrderExtras'))  get id OrderExtras
            $bedroomExtras = Session::get('bedroomExtras');
            $bathroomExtras = Session::get('bathroomExtras');
            $homeFootageExtras = Session::get('homeFootageExtras');
            $orderExtras = Session::has('idOrderExtras') ? OrderExtras::where('id',
                Session::get('idOrderExtras'))->first() : null;

            $orderPricing = new OrderPricing(Order::find(Session::get('orderId')));
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

            $order = Order::with('decryptionType')->find($id);

            // Get calculate sum
            $orderPricing = new OrderPricing($order);
            $order->total_sum = $orderPricing->calculate();
            $order->save();

            $user = User::findOrFail($order->user_id);

            // Send mail
            Mail::to('vasa@gmail.com')->send(new OrderShipped($order, $user));
            dd(1);
            $request->session()->flush();

            return back();
        }
    }
