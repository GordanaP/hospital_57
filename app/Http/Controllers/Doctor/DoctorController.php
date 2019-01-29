<?php

namespace App\Http\Controllers\Doctor;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Traits\Doctor\Crudable;
use App\Traits\RedirectTo;
use App\UseCases\RemoveResource;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use Crudable, RedirectTo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();

        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DoctorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequest $request)
    {
        $doctor = Doctor::create($this->attributes());

        return $this->redirectAfterStoring('doctors', $doctor)
            ->with($this->storeResponse());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DoctorRequest  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $doctor->image->removeOld($doctor->image);

        $doctor->update($this->attributes());

        return $this->redirectAfterUpdate('doctors', $doctor)
            ->with($this->updateResponse());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor | null  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor = null)
    {
        RemoveResource::perform('Doctor', $doctor);

        return $this->redirectAfterDeleting('doctors');
    }
}
