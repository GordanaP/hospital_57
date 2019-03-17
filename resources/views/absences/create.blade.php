@extends('layouts.admin')

@section('title', ' | Add Absence')

@section('links')
    <style>
        .ui-datepicker-unselectable.absent span {
            border-color: red !important;
        }
        .ui-datepicker-unselectable.holiday span {
            background: red !important;
            color: #ffffff !important;
        }
     </style>
@endsection

@section('content')

    <header class="flex items-center justify-between w-4/5 mx-auto mb-4">
        <h4>Create Absence</h4>

        <a href="{{ route('absences.index') }}" class="underline text-teal text-lg">
            Back to absences
        </a>
    </header>

    <main>
        @include('absences.forms._save', [
            'route' => route('absences.store'),
            'doctorId' => old('doctor_id'),
            'description' => old('description'),
            'start_at' => old('start_at'),
            'end_at' => old('end_at'),
            'btn_redirect' => 'Create Absence',
            'btn_back' => 'Create Absence & Add Another',
        ])
    </main>

@endsection

@section('scripts')
    <script>

        clearErrorOnNewInput()

        var startAt = $('#start_at');
        var endAt = $('#end_at');
        var doctorId = $('#doctor_id');
        dateFormat = "yy-mm-dd";
        var minDate = 0;
        var editAbsenceUrl = "{{ request()->route()->named('absences.edit') }}";

        @if (request()->route()->named('doctors.absences.create'))

            var absences = @json($doctor->absences);

            @include('absences.datepicker._from')

            @include('absences.datepicker._to')

        @else

            $(document).on("click", '#start_at', function() {

                var doctor = doctorId.val();

                if(doctor) {
                    $.when(ajaxCallDoctor(doctor)).done(function(response){

                        var absences = response.doctor.absences

                       @include('absences.datepicker._from')

                       from.focus();
                    });
                } else {
                    swalErrorMessage('Please select a doctor first!');
                }
            });

            $(document).on("click", '#end_at', function(){

                var doctor = doctorId.val();

                if(doctor) {
                    $.when(ajaxCallDoctor(doctor)).done(function(response){

                        var absences = response.doctor.absences

                        @include('absences.datepicker._to')

                        to.focus()
                    });
                } else {
                    swalErrorMessage('Please select a doctor first!');
                }
            });

            doctorId.on('change', function() {

                startAt.datepicker('setDate', null);
                startAt.datepicker("destroy");
                endAt.datepicker('setDate', null);
                endAt.datepicker("destroy");

                var doctor = $(this).val();

                if(doctor) {
                    $.when(ajaxCallDoctor(doctor)).done(function(response) {

                        var absences = response.doctor.absences

                        @include('absences.datepicker._from')

                        @include('absences.datepicker._to')
                    });
                } else {
                    swalErrorMessage('Please select a doctor first!');
                }
            });

        @endif
    </script>
@endsection