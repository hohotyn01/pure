<?php
    /**
     * Created by PhpStorm.
     * User: Anton
     * Date: 23.09.2019
     * Time: 16:29
     */

    namespace App\Repositories\Interfaces;

    use Illuminate\Database\Eloquent\Model;

    interface BaseInterface
    {
        public function find(int $id);

        public function firstOrCreate(array $array);

        public function updateOrCreate(array $array);

        public function setModel(Model $model);

    }