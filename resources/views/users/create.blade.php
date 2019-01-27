@extends('layouts.admin')

@section('title', ' | Add User')

@section('content')
    @include('users.forms._save', [
        'route' => route('users.store'),
        'name' => old('name'),
        'email' => old('email'),
        'btn_redirect' => 'Create User',
        'btn_back' => 'Create User & Add Another',
    ])
@endsection

@section('scripts')

    @include('users.js._toggle_hidden_field')

@endsection