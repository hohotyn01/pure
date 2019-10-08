<?php

namespace App\Http\Controllers;

use App\Exceptions\OrderNotFoundException;
use App\Http\Requests\RequestPayment;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Session;


class Payment extends Controller
{

    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function getPayment()
    {
        try {
            $order = $this->paymentService->getPayment(Session::get('orderId'));
        } catch (OrderNotFoundException $e) {
            $order = $this->paymentService->getOrder(Session::get('orderId'));

            return view(
                'payment',[
                'price' => $order->total_sum,
                // Form which gathers your customer's payment method details
                'intent' => $order->user->createSetupIntent()
            ]);
        }

        if ($order->cleaning_frequency == 'once') {
            return view(
                'payment',[
                'price' => $order->total_sum
            ]);
        }
    }

    public function postPayment(RequestPayment $requestPayment)
    {
        try {
            $this->paymentService->postPayment(
                Session::get('orderId'),
                $requestPayment->payment_method_id
            );
        } catch (OrderNotFoundException $e) {
            return redirect()->route('extras', ['message' => $e->getMessage()]);
        }

        return redirect()->route('extras', ['message' => "Thank you, payment was successful!"]);
    }

}