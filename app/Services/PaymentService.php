<?php

namespace App\Services;

use App\Exceptions\OrderNotFoundException;
use App\Models\Order;
use App\Models\User;
use App\Repositories\PaymentRepository;


class PaymentService extends BaseService
{
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function paymentGet($session)
    {
        // Get Order model
        $order = $this->paymentRepository->getOrderBySession($session);

        if ($order->cleaning_frequency != 'once') {
            throw new OrderNotFoundException("No once");
        }

        return $order;
    }

    public function arraySinge($session)
    {
        $order = $this->paymentRepository->getOrderBySession($session);

        return [
            'price' => $order->total_sum
        ];
    }

    public function arraySubscribe($session)
    {
        $order = $this->paymentRepository->getOrderBySession($session);

        return [
            'price' => $order->total_sum,
            'intent' => $this->paymentRepository->createSetupIntent($order)
        ];
    }









    public function createCustomer(User $user)
    {
        $customer = $user->createAsStripeCustomer([
            "name" => $user->first_name . ' ' . $user->last_name,
            "description" => "home cleaning",
            "phone" => $user->mobile_phone,
        ]);

        return $customer;
    }

    public function createPlan(Order $order, $firstName)
    {
        switch ($order->cleaning_frequency) {
            case 'weekly':
                $interval = 'week';
                break;
            case 'biweekly':
                $interval = 'week';
                break;
            case 'monthly':
                $interval = 'month';
                break;
        }

        $plan = \Stripe\Plan::create([
            'amount' => $order->total_sum,
            'currency' => 'usd',
            'interval' => $interval,
            "product" => [
                "name" => $firstName
            ],
            'nickname' => $order->cleaning_frequency,
            'interval_count' => $order->cleaning_frequency == 'biweekly' ? 2 : 1,
        ]);

        if (!$plan) {
            return false;
        }

        return $plan;
    }

    public function statusPayment(Order $order, $pay = false)
    {
        if ($pay) {
            $order->update(['status' => 'paid']);
        } else {
            $order->update(['status' => 'unpaid']);
        }
    }

}