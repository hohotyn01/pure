<?php

    namespace App\Services;


    abstract class BaseService
    {
        public $repo;

        public function find(int $id)
        {
            return $this->repo->find($id);
        }

        public function create(array $data)
        {
            return $this->repo->create($data);
        }

        public function update(array $data)
        {
            return $this->repo->update($data);
        }

        public function firstOrCreate(array $data)
        {
            return $this->repo->firstOrCreate($data);
        }

        public function updateOrCreate(array $id, array $updateData)
        {
            return $this->repo->updateOrCreate($id, $updateData);
        }

        public function where(string $column, $value)
        {
            return $this->repo->where($column, $value);
        }

        public function findWithRelation(int $id, string $relation)
        {
            return $this->repo->findWithRelation($id, $relation);
        }
    }