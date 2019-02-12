<?php

namespace App\Http\Controllers\Patient;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientDoctorRequest;
use App\Patient;
use App\Traits\RedirectTo;
use Illuminate\Http\Request;

class PatientDoctorController extends Controller
{
    use RedirectTo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $doctors = Doctor::orderBy('last_name')->get();

        return view('patients.add_doctor', compact('doctors', 'patient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientDoctorRequest $request, Patient $patient)
    {
        $doctor = Doctor::find($request->doctor_id);

        $patient->addDoctor($doctor);

        return $this->redirectAfterUpdate('patients', $patient)
            ->with($this->updateResponse('patients'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->detachDoctor();

        return back()
            ->with(getAlert('The doctor has been detached from the patient', 'success'));
    }
}
