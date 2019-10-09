<?php

namespace App\Repositories;

use App\Models\OrderDetailPhoto;

class PhotoRepositories extends BaseRepository
{
    public function __construct(OrderDetailPhoto $orderDetailPhoto)
    {
        $this->setModel($orderDetailPhoto);
    }
}