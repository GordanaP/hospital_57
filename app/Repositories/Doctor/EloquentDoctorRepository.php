<?php

namespace App\Repositories\Doctor;

use App\Repositories\EloquentRepository;
use App\Doctor;

class EloquentDoctorRepository extends EloquentRepository implements DoctorInterface
{
    protected $model;

    public function __construct(Doctor $model)
    {
        $this->model = $model;
    }
}