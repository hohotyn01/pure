<?php

    namespace App\Services;

    use App\Repositories\OrderRepository;

    class OrderServices extends BaseServices
    {
        protected $model;

        public function __construct (OrderRepository $orderRepository)
        {
            $this->model = $orderRepository;
        }

        public function findWithRelation (int $id, string $relation)
        {
            return $this->model->findWithRelation ($id, $relation);
        }
    }