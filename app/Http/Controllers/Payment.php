<?php

namespace App\Http\Controllers;

use App\Exceptions\OrderNotFoundException;
use App\Http\Requests\RequestPayment;
use App\Models\Order;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Session;


class Payment extends Controller
{

    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function paymentGet()
    {
        try {
            $order = $this->paymentService->paymentGet(Session::get('orderId'));

        } catch (OrderNotFoundException $e) {
            return view(
                'payment',
                $this->paymentService->arraySubscribe(Session::get('orderId'))
            );
        }

        if ($order->cleaning_frequency == 'once') {
            return view(
                'payment',
                $this->paymentService->arraySinge(Session::get('orderId'))
            );
        }
    }

    public function paymentPost(RequestPayment $requestPayment)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $order = Order::find(Session::get('orderId'));
        $user = $order->user;

        // Get payment method
        $paymentMethod = $requestPayment->payment_method_id;

        if ($order->cleaning_frequency == 'once') {
            // Single charge
            $pay = $user->charge($order->total_sum, $paymentMethod);
            $pay = $pay->status;
        } else {
            // Create new plan
            $plan = $this->paymentService->createPlan($order, $user->first_name);

            // Check plan
            if (!$plan) {
                return view('extras', ['message' => "Sorry, stripe plan did not create!"]);
            }

            // Create new subscribe
            $subscribe = $user->newSubscription($plan->nickname, $plan->id)->create($paymentMethod);
            $pay = $subscribe->exists;
        }

        // Add status in data base
        $this->paymentService->statusPayment($order, $pay);

        return redirect()->route('extras', ['message' => "Thank you, payment was successful!"]);
    }

}