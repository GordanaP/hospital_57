<form action="{{ $route }}" method="POST">

    @csrf
    @method('PUT')

    <div class="card card-shadow w-4/5 mx-auto">
        <div class="card-body">

            <div class=" p-4 -ml-5 border-l-4 border-teal-lighter">
                <p class="text-sm text-grey-darker font-gabriela">
                    * Required field
                </p>
            </div>

            <div class="form-group row p-3 w-4/5">
                <label for="doctor_id" class="col-sm-4 col-form-label
                text-md-right text-grey-dark">Doctor: <span class="text-red
                text-lg">*</span></label>

                <div class="col-sm-8 px-6">
                    <select name="doctor_id" id="doctor_id" class="form-control" >
                        <option value="">Select a doctor</option>
                        @foreach ($doctorsWithoutAccount as $doctor)
                            <option value="{{ $doctor->id }}"
                                {{ getSelected($doctor->id, $doctorId) }}
                            >
                                {{ $doctor->inverse_title_name }}
                            </option>
                        @endforeach
                    </select>

                    @include('errors._field', [
                        'field' => 'doctor_id',
                    ])
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="card-footer form-footer">
            <button type="submit" class="btn button-teal xl:float-right mr-6"
                name="submitbtn" value="doAndDisplay">
                {{ $btn_redirect }}
            </button>
        </div>
    </div>

</form>