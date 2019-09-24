<?php

    namespace App\Repositories;

    use App\Models\OrderDetail;

    class OrderDetailRepository extends BaseRepository
    {
        public function __construct (OrderDetail $orderDetail)
        {
            $this->setModel($orderDetail);
        }

        public function whereGetId (string $column, $value)
        {
            return $this->model->where($column, $value)->first()->id;
        }
    }