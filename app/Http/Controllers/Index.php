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

                $bedroom = range('1', '10', '1');
                $bathrom = range('1', '5', '0.5');

                return view('home', ['bedroom' => $bedroom, 'bathrom' => $bathrom]);
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
                $user = new User;
                $order = new Order;

                $user->email = $request->email;
                $order->bedroom = $request->bedroom;
                $order->bathroom = $request->bathroom;
                $order->zip_code = $request->zip_code;

                if (!$user->save()) {
                    abort(404);
//                    return view('question.single', compact('question'));
                }

                $order->user_id = $user->id;

                if (!$order->save()) {
                    abort(404);
                }

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
                    'cleaning_date' => 'required|in:next_available,this_week,next_week,this_month,i_am_flexible,just_need_a_quote',
                    'first_name' => 'required|max:150',
                    'last_name' => 'required|max:150',
                    'street_address' => 'required|max:150',
                    'apt' => 'max:15',
                    'city' => 'required|max:150',
                    'home_square_footage' => 'required|max:10',
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
                $user = new User;
                $order = new Order;

                $order->cleaning_frequency = $request->cleaning_frequency;
                $order->cleaning_type = $request->cleaning_type;
                $order->cleaning_date = $request->cleaning_date;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $order->street_address = $request->street_address;
                $order->apt = $request->apt;
                $order->city = $request->city;
                $order->home_square_footage = $request->home_footage;
                $user->mobile_phone = $request->mobile_phone;
                $order->about_us = $request->about_us;

                $user->save();
                $order->save();

                return redirect(route('home'));

                /*
                * Save End
                */
            }
        }

        public function yourHome(Request $request)
        {
            if ($request->isMethod('get')) {
                $rate = range('1', '10', '1');

                return view('your_home', ['rate' => $rate]);
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
                    'rate' => 'required|in:1,2,3,4,5,6,7,8,9,10',
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
                $OrderDetail = new OrderDetail;
                $OrderDetailPhoto = new OrderDetailPhoto;

                $OrderDetail->dogs_or_cats = $request->dogs_or_cats;
                $OrderDetail->pets_total = $request->pets_total;
                $OrderDetail->adults = $request->adults;
                $OrderDetail->children = $request->children;
                $OrderDetail->rate_cleanliness = $request->rate;
                $OrderDetail->cleaned_2_months_ago = $request->cleaned_2_months_ago;
                $OrderDetail->differently = $request->differently;
                $OrderDetailPhoto->photo_path = $request->photo;

                $OrderDetail->save();
                $OrderDetailPhoto->save();

                return redirect(route('materials'));
                /*
                * Save End
                */
            }
        }

        public function materials(Request $request)
        {
            if ($request->isMethod('get')) {
                return view('materials');
            }

            if ($request->isMethod('post')) {
                /*
                 * Validate Start
                 */
                $validator = Validator::make($request->all(), [
                    ''
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

                return redirect (route('extras'));
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
                $validarot = Validator::make($request->all(), [

                ]);

                if ($validarot->fails()) {
                    return back()
                        ->withErrors($validarot)
                        ->withInput();
                }
                /*
                * Validate End
                */
                /*
                * Save Start
                */
                return back();
                /*
                * Save End
                */
            }
        }
    }
