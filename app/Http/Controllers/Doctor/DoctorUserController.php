<?php

namespace App\Http\Controllers\Doctor;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\User\AccountCreated;
use App\Traits\RedirectTo;
use App\Traits\User\Crudable;
use App\Traits\User\GetAttributes;
use App\User;
use Illuminate\Support\Facades\Mail;

class DoctorUserController extends Controller
{
    use Crudable, GetAttributes, RedirectTo;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Doctor $doctor)
    {
        $doctorsWithoutAccount = Doctor::hasNoAccountCollection();

        return view('users.create', compact('doctorsWithoutAccount', 'doctor'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->user->delete();

        return back()->with($this->deleteResponse());
    }
}
