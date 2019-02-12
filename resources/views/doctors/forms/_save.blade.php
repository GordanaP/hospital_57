<form action="{{ $route }}" method="POST" enctype="multipart/form-data">

    @csrf

    @if (request()->route()->named('doctors.edit'))
        @method('PUT')
    @endif

    <div class="card card-shadow w-4/5 mx-auto">
        <div class="card-body">

            <div class=" p-4 -ml-5 border-l-4 border-teal-lighter">
                <p class="text-sm text-grey-darker font-gabriela">
                    * Required fields
                </p>
            </div>

            <!-- Image -->
            <div class="form-group row px-3 py-5 bg-grey-lightest mx-4">
                <label for="title" class="{{ request()->route()->named('doctors.edit') ? 'col-sm-6 py-0 pr-0 pl-4' :
                'col-sm-4' }} col-form-label text-md-right text-grey-dark">
                    @if (request()->route()->named('doctors.edit'))
                        <img src="{{ $doctor->image->display() }}" alt="{{ $doctor->full_name }}" class="w-2/5">
                    @else
                        Image:
                    @endif
                </label>

                <div class="{{ request()->route()->named('doctors.edit') ? 'col-sm-5' :
                'col-sm-8'}} px-6">
                    <input type="file" name="image" id="image" class="mt-1">
                    <span class="file-btn rounded-sm">
                        Choose file
                    </span>

                    <div class="mt-4">
                        @include('errors._field', [
                            'field' => 'image',
                        ])
                    </div>

                    @if (request()->route()->named('doctors.edit') && $doctor->image->image != null)
                        <div class="checkbox mt-16">
                            <label class="checkbox-container">
                                <input type="checkbox" class="checkitem" name="deleteImage" >
                                <span class="checkmark" id="file"></span>
                            </label>
                            <span class="text-sm ml-8">Delete file</span>
                        </div>

                        @include('errors._field', [
                            'field' => 'deleteImage',
                        ])
                    @endif
                </div>
            </div>

            <!-- Title -->
            <div class="form-group p-3">
                <label for="title" class="text-grey-dark">Title:<span class="text-red text-lg">*</span></label>
                <select name="title" id="title" class="form-control">
                    <option value="">Select a title</option>
                    @foreach (Title::all() as $key => $name)
                        <option value="{{ $key }}"
                            {{ getSelected($key, $title) }}
                        >
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @include('errors._field', [
                    'field' => 'title',
                ])
            </div>

            <div class="row">
                <!-- First Name -->
                <div class="col-md-6">
                    <div class="form-group p-3">
                        <label for="first_name" class="text-md-right text-grey-dark">First Name:<span class="text-red text-lg">*</span></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ $first_name }}">

                        @include('errors._field', [
                            'field' => 'first_name',
                        ])
                    </div>
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <div class="form-group p-3">
                        <label for="last_name" class="text-md-right text-grey-dark">Last Name:<span class="text-red text-lg">*</span></label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ $last_name }}">

                        @include('errors._field', [
                            'field' => 'last_name',
                        ])
                    </div>

                </div>
            </div>

            <div class="row">
                <!-- Specialty -->
                <div class="col-md-6">
                    <div class="form-group p-3">
                        <label for="specialty" class="text-md-right text-grey-dark">Specialty:<span class="text-red text-lg">*</span></label>
                        <select name="specialty" id="specialty" class="form-control">
                            <option value="">Select a specialty</option>
                            @foreach (Specialty::all() as $key => $name)
                                <option value="{{ $key }}"
                                    {{ getSelected($key, $specialty) }}
                                >
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                        @include('errors._field', [
                            'field' => 'specialty',
                        ])
                    </div>
                </div>

                <!-- License -->
                <div class="col-md-6">
                    <div class="form-group p-3">
                        <label for="license" class="text-md-right text-grey-dark ">License:<span class="text-white text-lg">*</span></label>
                        <input type="text" class="form-control" id="license" name="license" placeholder="License" value="{{ $license }}">

                        @include('errors._field', [
                            'field' => 'license',
                        ])
                    </div>
                </div>
            </div>

            <!-- Biography -->
            <div class="form-group p-3">
                <label for="biography" class="text-md-right text-grey-dark">Biography:</label>
                <textarea name="biography" id="biography" class="form-control" cols="30" rows="3" placeholder="biography">{{ $biography }}</textarea>

                @include('errors._field', [
                    'field' => 'biography',
                ])
            </div>

            <div class="row">
                <!-- Color -->
                <div class="col-md-6">
                    <div class="form-group p-3">
                        <label for="color" class="text-md-right text-grey-dark">Color:</label>
                        <select name="color" id="color" class="form-control">
                            <option value="">Select a color</option>
                            @foreach (Color::all() as $key => $name)
                                <option value="{{ $key }}"
                                    {{ getSelected($key, $color) }}
                                >
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                        @include('errors._field', [
                            'field' => 'color',
                        ])
                    </div>
                </div>

                <!-- App Slot -->
                <div class="col-md-6">
                    <div class="form-group p-3">
                        <label for="app_slot" class="text-md-right text-grey-dark">Appointment Slot:</label>
                        <select name="app_slot" id="app_slot" class="form-control">
                            <option value="">Select a slot</option>
                            @foreach (AppSlot::all() as $key => $name)
                                <option value="{{ $key }}"
                                    {{ getSelected($key, $app_slot) }}
                                >
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                        @include('errors._field', [
                            'field' => 'app_slot',
                        ])
                    </div>
                </div>
            </div>

            @if (request()->route()->named('users.doctors.create'))
                <div class="form-group p-3">
                    <label for="user_id" class="text-md-right text-grey-dark">User:</label>
                    <select name="user_id" id="user_id" class="form-control" disabled>
                        <option value="{{ $user->id}}">
                            {{ $user->email }}
                        </option>
                    </select>

                    @include('errors._field', [
                        'field' => 'user_id',
                    ])
                </div>
            @endif

        </div><!-- /.Card body -->

        <!-- Buttons -->
        <div class="card-footer form-footer">
            <button type="submit" class="btn button-teal xl:float-right mr-6"
                name="submitbtn"
                value="doAndDisplay">
                {{ $btn_redirect }}
            </button>

            <button type="submit" class="btn button-teal xl:float-right mr-6"
                name="submitbtn"
                value="doAndRepeat">
                {{ $btn_back }}
            </button>
        </div>
    </div>
</form>
