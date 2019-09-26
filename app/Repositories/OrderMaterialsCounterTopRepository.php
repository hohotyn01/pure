<?php

    namespace App\Repositories;

    use App\Models\OrderMaterialsCountertop;

    class OrderMaterialsCounterTopRepository extends BaseRepository
    {
        public function __construct (OrderMaterialsCountertop $orderMaterialsCountertop)
        {
            $this->setModel ($orderMaterialsCountertop);
        }
    }