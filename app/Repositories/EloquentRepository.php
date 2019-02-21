<?php

namespace App\Repositories;

class EloquentRepository implements EloquentRepositoryInterface
{
    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(array $attributes, $id, $getDataBack = false)
    {
        $update = $this->getById($id)->update($attributes);

        if($getDataBack)
        {
            $update = $this->getById($id);
        }

        return $update;
    }

    public function remove($id)
    {
        return $this->getById($id)->delete();
    }


}