<?php
    /**
     * Created by PhpStorm.
     * User: Anton
     * Date: 23.09.2019
     * Time: 16:30
     */

    namespace App\Repositories;

    use Illuminate\Database\Eloquent\Model;
    use App\Repositories\Interfaces\BaseInterface;
    use Throwable;

    abstract class BaseRepository implements BaseInterface
    {
        protected $model;

        public function __construct (Model $model)
        {
            $this->setModel ($model);
        }

        public function find (int $id)
        {
            try{
                return $this->model->find ($id);
            }catch (Throwable $error){
                dd($error->getMessage());
            }
        }

        public function firstOrCreate (array $id)
        {
            return $this->model->firstOrCreate($id);
        }

        public function updateOrCreate (array $id, array $updateData)
        {
            return $this->model->updateOrCreate ($id, $updateData);
        }

        public function setModel (Model $model)
        {
            $this->model = $model;

            return $this;
        }


    }