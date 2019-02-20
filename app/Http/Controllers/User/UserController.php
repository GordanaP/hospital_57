<?php

namespace App\Http\Controllers\User;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\User\AccountCreated;
use App\Mail\User\AccountUpdated;
use App\Traits\RedirectTo;
use App\UseCases\RemoveResource;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use RedirectTo;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctorsWithoutAccount = Doctor::hasNoAccountCollection();

        return view('users.create', compact('doctorsWithoutAccount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::createNew($request->only('name', 'email'));

        Mail::to($user)->send(new AccountCreated($user, User::getPassword($request->all())));

        return $this->redirectAfterStoring('users', $user)
            ->with($this->storeResponse());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $doctorsWithoutAccount = Doctor::hasNoAccountCollection($user);

        return view('users.edit', compact('doctorsWithoutAccount', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->saveChanges($request->all());

        Mail::to($user)
            ->send(new AccountUpdated($user, User::getPassword($request->all())));

        return $this->redirectAfterUpdate('users', $user)
            ->with($this->updateResponse());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User | null $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user = null)
    {
        RemoveResource::perform('User', $user);

        return $this->redirectAfterDeleting('users');
    }
}
