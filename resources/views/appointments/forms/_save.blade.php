<form id="appForm">
    <div class="modal-body">
        <p class="mb-4">
            <span class="text-red-dark bg-purple-lightest rounded-lg py-1 px-3">
                Appointment Details
            </span>
        </p>

        <!-- Doctor -->
        <div class="form-group">
            <label for="doctor_id">Doctor</label>
            <select type="text" name="doctor_id" id="doctor_id" class="form-control
                rounded-sm doctor_id"
                {{ request()->route()->named('doctors.appointments.index') ? 'disabled' : '' }}
            >
                @if (request()->route()->named('doctors.appointments.index'))
                    <option value="{{ $doctor->id }}">
                        {{ $doctor->title_name }}
                    </option>
                @else
                    <option value="">Select a doctor</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">
                            {{ $doctor->title_name }}
                        </option>
                    @endforeach
                @endif
            </select>

            <span class="invalid-feedback doctor_id"></span>
        </div>

        <!-- App Date & Time -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="app_date">Date</label>
                    <input type="text" name="app_date" id="app_date"
                        class="form-control rounded-sm app_date" placeholder="yyyy-mm-dd" />

                    <span class="invalid-feedback app_date"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="app_start">Time: <span id="app-time-label"></span></label>
                    <input type="text" name="app_start" id="app_start"
                        class="form-control rounded-sm app_start"
                        placeholder="hh:mm" />

                    <span class="invalid-feedback app_start"></span>
                </div>
            </div>
        </div>

        <p class="mt-3 mb-4">
            <span class="text-red-dark bg-purple-lightest rounded-lg py-1 px-3">
                Patient Details
            </span>
        </p>

        <!-- Patient first & last name -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" id="first_name"
                        class="form-control rounded-sm first_name"
                        placeholder="Enter first name" />

                    <span class="invalid-feedback first_name"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" id="last_name"
                        class="form-control rounded-sm last_name" placeholder="Enter last name" />

                    <span class="invalid-feedback last_name"></span>
                </div>
            </div>
        </div>

        <!-- Patient birthday and phone -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="birthday">Date of Birth</label>
                    <input type="text" name="birthday" id="birthday"
                        class="form-control rounded-sm birthday"
                        placeholder="yyyy-mm-dd" />

                    <span class="invalid-feedback birthday"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input type="text" name="phone" id="phone"
                        class="form-control rounded-sm phone"
                        placeholder="123456" />

                    <span class="invalid-feedback name phone"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action buttons -->
    <div class="modal-footer">
        <button type="button"
            class="pull-left text-red-dark font-bold underline mr-3" data-dismiss="modal">
                Close
        </button>
        <button type="button"
            class="btn bg-red-dark hover:bg-red-darker text-white rounded-sm"
            id="deleteApp">
                Cancel
        </button>
        <button type="button" class="btn rounded-sm app-button"></button>
    </div>

</form>
