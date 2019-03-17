<?php

namespace App\Http\Controllers\Doctor;

use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Doctor $doctor)
    {
        return view('doctors.show.profile', compact('doctor'));
    }
}
