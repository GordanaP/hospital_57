<form action="{{ $route }}" method="POST">

    @csrf

    @if (request()->route()->named('patients.edit'))
        @method('PUT')
    @elseif (request()->route()->named('patients.assign.doctor'))
        @method('PATCH')
    @endif

    <div class="card card-shadow w-4/5 mx-auto">
        <div class="card-body">

            <div class=" p-4 -ml-5 border-l-4 border-teal-lighter">
                <p class="text-sm text-grey-darker font-gabriela">
                    * Required fields
                </p>
            </div>

            <!-- First Name -->
            <div class="form-group row p-3 w-4/5">
                <label for="first_name" class="col-sm-4 col-form-label text-md-right text-grey-dark">First Name:<span class="text-red text-lg">*</span></label>

                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ $first_name }}">

                    @include('errors._field', [
                        'field' => 'first_name',
                    ])
                </div>
            </div>

            <!-- Last Name -->
            <div class="form-group row p-3 w-4/5">
                <label for="last_name" class="col-sm-4 col-form-label text-md-right text-grey-dark">Last Name:<span class="text-red text-lg">*</span></label>

                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ $last_name }}">

                    @include('errors._field', [
                        'field' => 'last_name',
                    ])
                </div>
            </div>

            <!-- Gender -->
            <div class="form-group row p-3 w-4/5">
                <label for="gender" class="col-sm-4 col-form-label text-md-right text-grey-dark">Gender:</label>

                <div class="col-sm-8 px-6">
                    <div>
                        <div class="flex">
                            <div class="checkbox my-2 mr-4">
                                <label class="checkbox-container"><input type="radio" class="checkitem" name="gender" value="M" {{ getChecked('M' , $gender) }} ><span class="checkmark radio-checkmark"></span></label> <span class="ml-8">Male</span>
                            </div>
                            <div class="checkbox my-2">
                                <label class="checkbox-container"><input type="radio" class="checkitem" name="gender" value="F" {{ getChecked('F' , $gender) }} ><span class="checkmark radio-checkmark"></span></label> <span class="ml-8">Female</span>
                            </div>
                        </div>
                    </div>

                    @include('errors._field', [
                        'field' => 'gender',
                    ])
                </div>
            </div>

            <!-- Birthday -->
            <div class="form-group row p-3 w-4/5">
                <label for="birthday" class="col-sm-4 col-form-label text-md-right text-grey-dark">Birthday:<span class="text-red text-lg">*</span></label>

                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Birthday" value="{{ $birthday }}">

                    @include('errors._field', [
                        'field' => 'birthday',
                    ])
                </div>
            </div>

            <!-- Street address -->
            <div class="form-group row p-3 w-4/5">
                <label for="address" class="col-sm-4 col-form-label text-md-right text-grey-dark">Street address:</label>

                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Street Address" value="{{ $address }}">

                    @include('errors._field', [
                        'field' => 'address',
                    ])
                </div>
            </div>

            <!-- Postal Code -->
            <div class="form-group row p-3 w-4/5">
                <label for="postal_code" class="col-sm-4 col-form-label text-md-right text-grey-dark">Postal Code:</label>

                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Postal Code" value="{{ $postal_code }}">

                    @include('errors._field', [
                        'field' => 'postal_code',
                    ])
                </div>
            </div>

            <!-- City -->
            <div class="form-group row p-3 w-4/5">
                <label for="city" class="col-sm-4 col-form-label text-md-right text-grey-dark">City:</label>

                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ $city }}">

                    @include('errors._field', [
                        'field' => 'city',
                    ])
                </div>
            </div>

            <!-- Phone -->
            <div class="form-group row p-3 w-4/5">
                <label for="phone" class="col-sm-4 col-form-label text-md-right text-grey-dark">Phone Number:</label>

                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{ $phone }}">

                    @include('errors._field', [
                        'field' => 'phone',
                    ])
                </div>
            </div>

            <!-- Doctor -->
            <div class="form-group row p-3 w-4/5">
                <label for="doctor_id" class="col-sm-4 col-form-label text-md-right text-grey-dark">Doctor:</label>

                <div class="col-sm-8 px-6">
                    <select name="doctor_id" id="doctor_id" class="form-control"
                        {{ request()->route()->named('doctors.patients.create') ? 'read-only' : '' }}
                    >
                        @if (request()->route()->named('doctors.patients.create'))
                            <option value="{{ $doctor->id }}" selected>
                                {{ $doctor->inverse_title_name }}
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

        </div>

        <!-- Buttons -->
        <div class="card-footer form-footer">
            <button type="submit" class="p-2 rounded bg-teal hover:bg-teal-dark text-lg text-white float-right mr-6" name="submitbtn" value="doAndDisplay">
                    {{ $btn_redirect ?? '' }}
                </button>

            <button type="submit" class="p-2 rounded bg-teal-light hover:bg-teal-dark text-lg text-white float-right mr-6" name="submitbtn" value="doAndRepeat">
                {{ $btn_back ?? '' }}
            </button>
        </div>

    </div>

</form>