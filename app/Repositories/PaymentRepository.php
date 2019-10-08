<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\Order;


class PaymentRepository extends BaseRepository
{
    public function __construct(Payment $payment)
    {
        $this->setModel($payment);
    }

    public function getOrderBySession($session)
    {
        return Order::find($session);
    }

    // Form which gathers your customer's payment method details
    public function createSetupIntent(Order $order)
    {
        $order->user->createSetupIntent();
    }
}