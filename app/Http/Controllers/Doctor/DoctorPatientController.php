<?php

namespace App\Http\Controllers\Doctor;

use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorPatientController extends Controller
{
    public function __invoke(Doctor $doctor)
    {
        return view('patients.create', compact('doctor'));
    }
}
