<?php

namespace App\Http\Controllers\User;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Traits\RedirectTo;
use App\User;
use Illuminate\Http\Request;

class UserDoctorController extends Controller
{
    use RedirectTo;

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('doctors.create', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->doctor->detachUser();

        return back();
    }
}
