<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Doctor;
use App\Services\CustomClasses\AppCarbon;
use App\Traits\Resourceable;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    use Resourceable;

    /**
     * Get the user resource collection.
     *
     * @return JSON response
     */
    public function usersIndex()
    {
        $users = $this->usersResourceCollection();

        return response([
            'data' => $users
        ]);
    }

    /**
     * Get the doctor resource collection.
     *
     * @return array
     */
    public function doctorsIndex()
    {
        $doctors = $this->doctorsResourceCollection();

        return response([
            'data' => $doctors
        ]);
    }

    /**
     * Get the patient resource collection.
     *
     * @param  \App\Doctor | null $doctor
     * @return JSON response
     */
    public function patientsIndex(Doctor $doctor = null)
    {
        $patients = $this->patientsResourceCollection($doctor);

        return response([
            'data' => $patients
        ]);
    }

    /**
     * Get the absence resource collection.
     *
     * @param  \App\Doctor | null $doctor
     * @return JSON response
     */
    public function absencesIndex(Doctor $doctor = null)
    {
        $absences = $this->absencesResourceCollection($doctor);

        return response([
            'data' => $absences
        ]);
    }

    /**
     * Get the appointments.
     *
     * @return Illuminate\Support\Collection
     */
    public function appointmentsIndex(Doctor $doctor = null)
    {
        return $doctor ? $doctor->appointments->load('doctor', 'patient')
                       : Appointment::with('doctor', 'patient')->get() ;
    }

    /**
     * Edit a specific appointment
     *
     * @param  \App\Appointment $appointment
     * @return JSON response
     */
    public function appointmentsEdit(Appointment $appointment)
    {
        return response([
            'app' => $appointment->load('patient')
        ]);
    }

    /**
     * The booked slots on a specific date.
     *
     * @param  Request $request
     * @param  integer  $doctorId
     * @return JSON response
     */
    public function appointmentsBookedSlots(Request $request, $doctorId)
    {
        $doctor = Doctor::find($doctorId);
        $date = $request->appointment_date;

        return response([
            'minTime' => $doctor->startsWork($date),
            'maxTime' => $doctor->endsWork($date),
            'bookedSlots' => $doctor->getBookedSlots($date)
        ]);
    }
}