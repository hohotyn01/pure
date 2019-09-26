<?php

    namespace App\Repositories;

    use Illuminate\Database\Eloquent\Model;
    use App\Repositories\Interfaces\BaseInterface;
    use Throwable;

    abstract class BaseRepository implements BaseInterface
    {
        protected $model;

        public function __construct(Model $model)
        {
            $this->setModel($model);
        }

        public function find(int $id)
        {
            return $this->model->find($id);
        }

        public function create(array $data)
        {
            return $this->model->create($data);
        }

        public function update(array $data)
        {
            return $this->model->update($data);
        }

        public function firstOrCreate(array $data)
        {
            return $this->model->firstOrCreate($data);
        }

        public function updateOrCreate(array $data, array $updateData)
        {
            return $this->model->updateOrCreate($data, $updateData);
        }

        public function where(string $column, $value)
        {
            return $this->model->where($column, $value)->first();
        }

        public function findWithRelation(int $id, string $relation)
        {
            return $this->model->with($relation)->find($id);
        }

        public function setModel(Model $model)
        {
            $this->model = $model;

            return $this;
        }
    }