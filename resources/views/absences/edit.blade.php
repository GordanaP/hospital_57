@extends('layouts.admin')

@section('title', ' | Edit Absence')

@section('links')
    <style>
        .ui-datepicker-unselectable.absent span {
            background: red !important;
            color: #ffffff !important;
        }

        .to-edit a {
            background: green !important;
            color: #ffffff !important;
        }

        .absent a {
            background: red !important;
            color: #ffffff !important;
        }
     </style>
@endsection

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Edit Absence</h4>

        <a href="{{ route('absences.index') }}" class="underline text-teal text-lg">
            Back to absences
        </a>
    </header>

    <main>
        @include('absences.forms._save', [
            'route' => route('absences.update', $absence),
            'doctorId' => old('doctor_id') ?: $absence->doctor_id,
            'description' => old('description') ?: $absence->description,
            'start_at' => old('start_at')  ?: $absence->start_at,
            'end_at' => old('end_at')  ?: $absence->end_at,
            'btn_redirect' => 'Save Changes',
            'btn_back' => 'Save & Continue Editing',
        ])
    </main>

@endsection

@section('scripts')
    <script>

        clearErrorOnNewInput()

        var startAt = $('#start_at');
        var endAt = $('#end_at');
        var minDate = '';
        var doctorId = "{{ $absence->doctor->id }}";
        var absenceId = "{{ $absence->id }}";

        $.when(ajaxCallDoctor(doctorId)).done(function(response){

            var absences = response.doctor.absences

            startAt.on('click', function(){
                @include('absences.datepicker._from')
                from.focus();
            });

            $(document).on('click', '#end_at', function(){
                @include('absences.datepicker._to')
                to.focus();
            });
        });

    </script>
@endsection