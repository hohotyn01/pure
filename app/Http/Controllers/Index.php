<?php

    namespace App\Http\Controllers;

    use Illuminate\Support\Facades\DB;
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
                $bedroom = [
                    '1 Bedroom',
                    '2 Bedroom',
                    '3 Bedroom',
                    '4 Bedroom',
                    '5 Bedroom',
                    '6 Bedroom',
                    '7 Bedroom',
                    '8 Bedroom',
                    '9 Bedroom',
                    '10 Bedroom'
                ];
                $bathrom = [
                    '1 Bathroom',
                    '1.5 Bathroom',
                    '2 Bathroom',
                    '2.5 Bathroom',
                    '3 Bathroom',
                    '3.5 Bathroom',
                    '4 Bathroom',
                    '4.5 Bathroom',
                    '5 Bathroom'
                ];
                return view('home', ['bedroom' => $bedroom, 'bathrom' => $bathrom]);
            }

            if ($request->isMethod('post')) {
                /*
                 * Validate Start
                 */
                $validator = Validator::make($request->all(), [
                    'bedroom' => 'required',
                    'bathroom' => 'required',
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
                $user = new User;
                $order = new Order;

                $user->email = $request->email;
                $order->bedroom = $request->bedroom;
                $order->bathroom = $request->bathroom;
                $order->zip_code = $request->zip_code;

                $user->save();

                if ($user->save()) {
                    $order->user_id = $user->latest('id')->first()->id;

                }

                $order->save();

                return redirect(route('info'));
                /*
                 * Save end
                 */
            }
        }

        public function personalInfo(Request $request)
        {
            if ($request->isMethod('get')) {
                return view('personal_info');
            }

            if ($request->isMethod('post')) {

                /*
                * Validate Start
                */
                $validator = Validator::make($request->all(), [
                    'cleaning_frequency' => 'required|in:once,weekly,biweekly,monthly',
                    'cleaning_type' => 'required|in:deep_or_spring,move_in,move_out,post_remodeling',
                    'cleaning_date' => 'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'street_address' => 'required',
                    'apt' => '',
                    'city' => 'required',
                    'home_square_footage' => 'required',
                    'mobile_phone' => 'required',
                    'about_us' => 'required'
                ]);

            }
        }

        public function yourHome(Request $request)
        {
            if ($request->isMethod('get')) {
                return view('your_home');
            }

            if ($request->isMethod('post')) {
                echo 1;
            }
        }

        public function materials(Request $request)
        {
            if ($request->isMethod('get')) {
                return view('materials');
            }

            if ($request->isMethod('post')) {
                echo 1;
            }
        }

        public function extras(Request $request)
        {
            if ($request->isMethod('get')) {
                return view('extras');
            }

            if ($request->isMethod('post')) {
                echo 1;
            }
        }
    }
