<?php

namespace App\Http\Controllers;

use App\Doctor;
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

    /**
     * Get the patient resource collection.
     *
     * @param  \App\Doctor | null $doctor
     * @return JSON response
     */
    public function patientsIndex(Doctor $doctor = null)
    {
        $patients = $this->patientsResourceCollection($doctor);

        return response([
            'data' => $patients
        ]);
    }
}
