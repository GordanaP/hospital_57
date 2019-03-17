<?php

namespace App\Http\Controllers\Doctor;

use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorPatientController extends Controller
{
    public function create(Doctor $doctor)
    {
        return view('patients.create', compact('doctor'));
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show.patients', compact('doctor'));
    }
}
