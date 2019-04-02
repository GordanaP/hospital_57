<form action="{{ $route }}" method="POST">

    @csrf

    @if (request()->route()->named('absences.edit'))
        @method('PUT')
    @endif

    <div class="card card-shadow w-4/5 mx-auto">
        <div class="card-body">

            <div class=" p-4 -ml-5 border-l-4 border-teal-lighter">
                <p class="text-sm text-grey-darker font-gabriela">
                    * Required fields
                </p>
            </div>

            <!-- Doctor -->
            <div class="form-group row p-3 w-4/5">
                <label for="doctor_id" class="col-sm-4 col-form-label text-md-right text-grey-dark">Doctor:<span class="text-red text-lg">*</span></label>

                <div class="col-sm-8 px-6">
                    <select name="doctor_id" id="doctor_id" class="form-control"
                        {{ request()->route()->named('doctors.absences.create') ||
                            request()->route()->named('absences.edit')
                            ? 'read-only' : '' }}
                    >
                        @if (request()->route()->named('doctors.absences.create'))
                            <option value="{{ $doctor->id }}" selected>
                                {{ $doctor->inverse_title_name }}
                            </option>
                        @elseif(request()->route()->named('absences.edit'))
                            <option value="{{ $absence->doctor->id }}" selected>
                                {{ $absence->doctor->inverse_title_name }}
                            </option>
                        @else
                            <option value="">Select a doctor</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                    {{ getSelected($doctor->id, $doctorId) }}
                                >
                                    {{ $doctor->inverse_title_name }}
                                </option>
                            @endforeach
                        @endif
                    </select>

                    @include('errors._field', [
                        'field' => 'doctor_id',
                    ])
                </div>
            </div>

            <!-- Description -->
            <div class="form-group row p-3 w-4/5">
                <label for="leave_type_id" class="col-sm-4 col-form-label text-md-right text-grey-dark">Absence Reason:<span class="text-red text-lg">*</span></label>

                <div class="col-sm-8 px-6">
                    <select name="leave_type_id" id="leave_type_id" class="form-control">
                        <option value="">Select a reason</option>
                        @foreach (\App\LeaveType::all() as $type)
                            <option value="{{ $type->id }}"
                                {{ getSelected($type->id, $leave_type_id) }}
                            >
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>

                    @include('errors._field', [
                        'field' => 'leave_type_id',
                    ])
                </div>
            </div>

            <!-- Start -->
            <div class="form-group row p-3 w-4/5">
                <label for="start_at" class="col-sm-4 col-form-label text-md-right text-grey-dark">Start at:<span class="text-red text-lg">*</span></label>

                <div class="col-sm-8 px-6">

                    <input type="text" class="form-control" id="start_at" name="start_at" placeholder="yyyy-mm-dd" value="{{ $start_at }}">

                    <div id="datepicker1"></div>

                    <span class="form-control-feedback" style="position: relative; top: -30px; float: right; margin-right: 8px">
                        <i class="fa fa-calendar open-start-datepicker"></i>
                    </span>

                    @include('errors._field', [
                        'field' => 'start_at',
                    ])
                </div>
            </div>

            <!-- End -->
            <div class="form-group row p-3 w-4/5">
                <label for="end_at" class="col-sm-4 col-form-label text-md-right text-grey-dark">End at:</label>

                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="end_at" name="end_at" placeholder="yyyy-mm-dd" value="{{ $end_at }}">

                    <span class="form-control-feedback" style="position: relative; top: -30px; float: right; margin-right: 8px">
                        <i class="fa fa-calendar open-end-datepicker"></i>
                    </span>

                    @include('errors._field', [
                        'field' => 'end_at',
                    ])
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="card-footer form-footer">
            <button type="submit" class="p-2 rounded bg-teal hover:bg-teal-dark text-lg text-white float-right mr-6" name="submitbtn" value="doAndDisplayIndex">
                    {{ $btn_redirect ?? '' }}
                </button>

            <button type="submit" class="p-2 rounded bg-teal-light hover:bg-teal-dark text-lg text-white float-right mr-6" name="submitbtn" value="doAndRepeat">
                {{ $btn_back ?? '' }}
            </button>
        </div>

    </div>

</form>