<?php

    namespace App\Services;


    abstract class BaseServices
    {
        protected $model;

        public function find (int $id)
        {
            return $this->model->find ($id);
        }

        public function firstOrCreate (array $array)
        {
            return $this->model->firstOrCreate ($array);
        }

        public function updateOrCreate (array $array)
        {
            return $this->model->updateOrCreate($array);
        }
    }