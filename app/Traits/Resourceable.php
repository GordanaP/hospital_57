<?php

namespace App\Traits;

use App\Http\Resources\UserResource;
use App\User;


trait Resourceable
{
    /**
     * Get the user collection.
     *
     * @return Illuminate\Support\Collection
     */
    public function usersResourceCollection()
    {
        $users = User::all();

        return UserResource::collection($users);
    }
}
