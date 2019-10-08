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

    public function getOrder($id)
    {
        return Order::find($id);
    }

    public function updateOrder(Order $order, array $array)
    {
        $order->update($array);
    }
}