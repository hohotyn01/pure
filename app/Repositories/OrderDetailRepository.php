<?php

    namespace App\Repositories;

    use App\Models\OrderDetail;

    class OrderDetailRepository extends BaseRepository
    {
        public function __construct (OrderDetail $orderDetail)
        {
            $this->setModel ($orderDetail);
        }
    }