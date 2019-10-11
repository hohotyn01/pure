<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderDetailPhoto;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $order)
    {
        $this->setModel($order);
    }

    public function createOrderPath($path, $orderId)
    {
        orderDetailPhoto::create(['order_id' => $orderId, 'photo_path' => $path]);
    }

    public function getOrderPath(string $column, $orderId)
    {
        return orderDetailPhoto::where($column, $orderId)->get();
    }

    public function softDeletePhoto($id, $idOrder)
    {
        OrderDetailPhoto::where([
            ['id', $id],
            ['order_id', $idOrder]
        ])->delete();
    }
}