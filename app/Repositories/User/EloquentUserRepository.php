<?php

namespace App\Repositories\User;

use App\Doctor;
use App\Repositories\EloquentRepository;
use App\User;

class EloquentUserRepository extends EloquentRepository implements UserRepositoryInterface
{
    protected $model;
    protected $doctor;

    public function __construct(User $model, Doctor $doctor)
    {
        $this->model = $model;
        $this->doctor = $doctor;
    }

    public function create(array $attributes)
    {
        return $this->model->create($this->getUserAttributes($attributes));
    }

    private function getUserAttributes(array $attributes)
    {
        if (request('handle-password') == 'auto') {

            $attributes['password'] = str_random(6);
        }
        else if (request('handle-password') == 'manual') {

            $attributes['password'] = request('password');
        }

        return $attributes;
    }
}