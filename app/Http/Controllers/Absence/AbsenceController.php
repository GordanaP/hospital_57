<?php

namespace App\Http\Controllers\Absence;

use App\Absence;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\AbsenceRequest;
use App\Traits\RedirectTo;
use App\UseCases\RemoveResource;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    use RedirectTo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absences = Absence::all();

        return view('absences.scheduler', compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::orderBy('last_name')->get();

        return view('absences.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AbsenceRequest $request)
    {
        Absence::createNew($request->except('doctor_id'));

        return $this->redirectAfterStoring('absences')
            ->with($this->storeResponse('absences'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function show(Absence $absence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function edit(Absence $absence)
    {
        $doctors = Doctor::orderBy('last_name')->get();

        return view('absences.edit', compact('doctors', 'absence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function update(AbsenceRequest $request, Absence $absence)
    {
        $absence->saveChanges($request->except('doctor_id'));

        return $this->redirectAfterUpdate('absences', $absence)
            ->with($this->updateResponse('absences'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absence $absence = null)
    {
        RemoveResource::perform('Absence', $absence);

        return $this->redirectAfterDeleting('absences');
    }
}
