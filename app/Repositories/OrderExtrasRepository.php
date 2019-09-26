<?php

    namespace App\Repositories;

    use App\Models\OrderExtras;

    class OrderExtrasRepository extends BaseRepository
    {
        public function __construct (OrderExtras $orderExtras)
        {
            $this->setModel ($orderExtras);
        }
    }