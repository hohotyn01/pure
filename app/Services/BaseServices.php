<?php

    namespace App\Services;


    abstract class BaseServices
    {
        protected $model;

        public function find (int $id)
        {
            return $this->model->find ($id);
        }

        public function firstOrCreate (array $id)
        {
            return $this->model->firstOrCreate ($id);
        }

        public function updateOrCreate (array $id, array $updateData )
        {
            return $this->model->updateOrCreate ($id, $updateData);
        }
    }