<?php

namespace App\Http\Controllers\Patient;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Traits\RedirectTo;
use App\UseCases\RemoveResource;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    use RedirectTo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::orderBy('last_name')->get();

        return view('patients.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = Patient::createNew($request->except('doctor_id'));

        return $this->redirectAfterStoring('patients', $patient)
            ->with($this->storeResponse('patients'));
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
        $doctors = Doctor::orderBy('last_name')->get();

        return view('patients.edit', compact('doctors', 'patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $patient->saveChanges($request->except('doctor_id'));

        return $this->redirectAfterUpdate('patients', $patient)
            ->with($this->updateResponse('patients'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient = null)
    {
        RemoveResource::perform('Patient', $patient);

        return $this->redirectAfterDeleting('patients');
    }
}
