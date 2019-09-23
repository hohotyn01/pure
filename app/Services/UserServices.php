<?php

    namespace App\Services;

    use App\Repositories\UserRepository;

    class UserServices extends BaseServices
    {
        protected $model;

        public function __construct (UserRepository $userServices)
        {
            $this->model = $userServices;
        }
    }