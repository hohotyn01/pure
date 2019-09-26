<?php

    namespace App\Services;

    use App\Repositories\UserRepository;

    class UserService extends BaseService
    {
        public function __construct(UserRepository $userRepository)
        {
            $this->repo = $userRepository;
        }

        public function findByEmailOrCreate(string $email)
        {
            return $this->firstOrCreate(['email' => $email]);
        }
    }