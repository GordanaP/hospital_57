<?php

namespace App\Http\Controllers\Doctor;

use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorAbsenceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Doctor $doctor)
    {
        $doctors = Doctor::orderBy('last_name')->get();

        return view('absences.create', compact('doctors', 'doctor'));
    }

    public function show(Doctor $doctor)
    {
        return view('absences.show', compact('doctor'));
    }
}
