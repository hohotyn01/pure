<?php

namespace App\Services;

use App\Exceptions\OrderNotFoundException;
use App\Models\Order;
use App\Repositories\PaymentRepository;
use Stripe\Plan;
use Stripe\Stripe;


class PaymentService extends BaseService
{
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getPayment($id)
    {
        // Get Order model
        $order = $this->getOrder($id);

        if ($order->cleaning_frequency != 'once') {
            throw new OrderNotFoundException("No once");
        }

        return $order;
    }

    public function postPayment($id, $paymentMethod)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $order = $this->paymentRepository->getOrder($id);
        $user = $order->user;

        if ($order->cleaning_frequency == 'once') {
            // Single charge for Stripe API
            $pay = $user->charge($order->total_sum, $paymentMethod);
            $pay = $pay->status;
        } else {
            // Create new plan
            $plan = $this->createPlan($order, $user->first_name);

            if (!$plan){
                throw new OrderNotFoundException("Sorry, stripe plan did not create!");
            }

            // Create new subscribe
            $subscribe = $user->newSubscription($plan->nickname, $plan->id)->create($paymentMethod);
            $pay = $subscribe->exists;
        }

        // Update status payment
        if ($pay) {
            $this->paymentRepository->updateOrder($order, ['status' => 'paid']);
        }
    }

    public function updateStatusPayment(Order $order, $pay = false)
    {
        if ($pay) {
            $order->update(['status' => 'paid']);
        }
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

        // Create API Stripe plan payment
        $plan = Plan::create([
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

    public function getOrder($id)
    {
        return $this->paymentRepository->getOrder($id);
    }
}