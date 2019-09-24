<?php

    namespace App\Services;

    use App\Repositories\OrderDetailRepository;

    class OrderDetailService extends BaseServices
    {
        protected $model;

        public function __construct (OrderDetailRepository $orderDetailRepository)
        {
            $this->model = $orderDetailRepository;
        }

        public function whereGetId (string $column, $value)
        {
            return $this->model->whereGetId ($column, $value);
        }
    }