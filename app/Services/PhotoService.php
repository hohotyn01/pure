<?php

namespace App\Services;

use App\Models\OrderDetailPhoto;

class PhotoService
{
    private $orderDetailPhoto;

    public function __construct(OrderDetailPhoto $orderDetailPhoto)
    {
        $this->orderDetailPhoto = $orderDetailPhoto;
    }
}