<?php

    namespace App\Repositories;

    use App\Models\OrderMaterialsDetail;

    class OrderMaterialsDetailRepository extends BaseRepository
    {
        public function __construct (OrderMaterialsDetail $orderMaterialsDetail)
        {
            $this->setModel ($orderMaterialsDetail);
        }
    }