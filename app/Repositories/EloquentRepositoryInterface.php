<?php

namespace App\Repositories;

interface EloquentRepositoryInterface
{
    public function getById($id);
    public function getAll();
    public function create(array $attributes);
    public function update(array $attributes, $id);
    public function remove($id);
}