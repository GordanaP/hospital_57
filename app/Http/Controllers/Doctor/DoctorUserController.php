<?php

namespace App\Http\Controllers\Doctor;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Traits\RedirectTo;
use App\Traits\User\Crudable;
use App\User;
use Illuminate\Http\Request;

class DoctorUserController extends Controller
{
    use Crudable, RedirectTo;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Doctor $doctor)
    {
        return view('users.create', compact('doctor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Doctor $doctor)
    {
        User::create($this->attributes())->addDoctor($doctor);

        return $this->redirectAfterStoring('users', $doctor->user)
            ->with($this->storeResponse());
    }
}
