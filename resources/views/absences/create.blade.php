@extends('layouts.admin')

@section('title', ' | Add Absence')

@section('links')
    <style>
        .ui-datepicker-unselectable.absent span {
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

        var startAt = $('#start_at')
        var endAt = $('#end_at')
        var doctorId = $('#doctor_id')

        $("#start_at, .open-start-datepicker").bind("click", function(){
            doctorId.val() ? startAt.datepicker('show')
                : Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please select a doctor first!',
                });
        });

        $("#end_at, .open-end-datepicker").bind("click", function(){
            doctorId.val() ? endAt.datepicker('show')
                : Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please select a doctor first!',
                });
        });


        @if (request()->route()->named('doctors.absences.create'))

            var absences = @json($doctor->absences);

            @include('absences.datepicker._from_to_pair')
        @else

            $('#doctor_id').on('change', function(){

                startAt.datepicker('setDate', null);
                startAt.datepicker("destroy");
                endAt.datepicker('setDate', null);
                endAt.datepicker("destroy");

                var doctorId = $(this).val();
                var showDoctorUrl = '/api/doctors/'+doctorId;
                var absences;

                $.ajax({
                    url: showDoctorUrl,
                    type: "POST",
                }).done(function(response){
                    absences = response.doctor.absences;
                });

                @include('absences.datepicker._from_to_pair')
            });

        @endif

    </script>
@endsection