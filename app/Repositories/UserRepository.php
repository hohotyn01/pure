<?php
    /**
     * Created by PhpStorm.
     * User: Anton
     * Date: 23.09.2019
     * Time: 18:35
     */

    namespace App\Repositories;

    use App\Models\User;

    class UserRepository extends BaseRepository
    {
        public function __construct(User $user)
        {
            $this->setModel($user);
        }
    }