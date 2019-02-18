<?php

namespace App\Http\Controllers\Doctor;

use App\Appointment;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Patient;
use Illuminate\Http\Request;

class DoctorAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Doctor $doctor)
    {
        $doctors = Doctor::all();

        return view('appointments.index', compact('doctors', 'doctor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AppointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request, Doctor $doctor)
    {
        $appointment = Appointment::createNew($doctor);

        return response([
            'message' => 'A new appointment has been scheduled.',
            'appointment' => $appointment
        ]);
    }
}

