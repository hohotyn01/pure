<?php

    namespace App\Repositories;

    use App\Models\Order;

    class OrderRepository extends BaseRepository
    {

        public function __construct(Order $order)
        {
            $this->setModel($order);
        }

        public function findWithRelation (int $id, string $relation)
        {
            return $this->model->with($relation)->find($id);
        }
    }