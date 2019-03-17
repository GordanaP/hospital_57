<?php

namespace App\Http\Controllers\Doctor;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Traits\RedirectTo;
use App\WorkingDay;

class DoctorWorkScheduleController extends Controller
{
    use RedirectTo;

    public function show(Doctor $doctor)
    {
        $business_days = WorkingDay::all();

        return view('doctors.show.schedule', compact('doctor', 'business_days'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $business_days = WorkingDay::all();

        return view('schedules.edit', compact('doctor', 'business_days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, Doctor $doctor)
    {
        $doctor->addWorkSchedule($request->days);

        return $this->redirectAfterSavingSchedule('doctors', $doctor)
            ->with($this->saveResponse('schedule'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->deleteWorkSchedule();

        return back()
            ->with(getAlert('The work schedule has been deleted.', 'success'));
    }
}
