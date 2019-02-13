@extends('layouts.admin')

@section('title', ' | Doctor | Edit Work Schedule')

@section('content')

    <h4>{{ $doctor->hasWorkSchedule() ? 'Edit' : 'Create' }} Schedule</h4>

@endsection