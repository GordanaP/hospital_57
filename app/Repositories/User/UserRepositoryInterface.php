<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepositoryInterface;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    public function getAll();
    public function create(array $attributes);
}
