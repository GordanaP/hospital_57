<?php

namespace App\Http\Controllers;

use App\Traits\Resourceable;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    use Resourceable;

    /**
     * Get the user resource collection.
     *
     * @return JSON response
     */
    public function usersIndex()
    {
        $users = $this->usersResourceCollection();

        return response([
            'data' => $users
        ]);
    }

    /**
     * Get the doctor resource collection.
     *
     * @return array
     */
    public function doctorsIndex()
    {
        $doctors = $this->doctorsResourceCollection();

        return response([
            'data' => $doctors
        ]);
    }
}
