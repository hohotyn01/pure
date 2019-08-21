<?php

    namespace App\Http\Controllers;

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
                    'zip' => 'required|max:10',
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
                echo 1;
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
