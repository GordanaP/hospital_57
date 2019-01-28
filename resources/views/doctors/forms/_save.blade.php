<form action="{{ $route }}" method="POST" enctype="multipart/form-data">

    @csrf

    @if (request()->route()->named('doctors.edit'))
        @method('PUT')
    @endif

    <div class="card  card-shadow w-4/5 mx-auto">
        <div class="card-body">

            <div class=" p-4 -ml-5 border-l-4 border-teal-lighter">
                <p class="text-sm text-grey-darker font-gabriela">
                    * Required fields
                </p>
            </div>

            <!-- Image -->
            <div class="form-group row p-3 w-4/5">
                <label for="title" class="{{ request()->route()->named('doctors.edit') ? 'col-sm-7 py-0 pr-0 pl-4' :
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

                    @include('errors._field', [
                        'field' => 'image',
                    ])

                    @if (request()->route()->named('doctors.edit') && $doctor->image->image != null)
                        <div class="checkbox mt-16">
                            <label class="checkbox-container">
                                <input type="checkbox" class="checkitem" name="deleteImage" >
                                <span class="checkmark"></span>
                            </label>
                            <span class="text-sm ml-8">Delete file</span>
                        </div>
                    @endif

                    @include('errors._field', [
                        'field' => 'deleteImage',
                    ])
                </div>
            </div>

            <!-- Title -->
            <div class="form-group row p-3 w-4/5">
                <label for="title" class="col-sm-4 col-form-label text-md-right text-grey-dark">Title:<span class="text-red text-lg">*</span></label>
                <div class="col-sm-8 px-6">
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
            </div>

            <!-- First Name -->
            <div class="form-group row p-3 xl:w-4/5">
                <label for="first_name" class="col-sm-4 col-form-label text-md-right text-grey-dark">First Name:<span class="text-red text-lg">*</span></label>
                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ $first_name }}">

                    @include('errors._field', [
                        'field' => 'first_name',
                    ])
                </div>
            </div>

            <!-- Last Name -->
            <div class="form-group row p-3 xl:w-4/5">
                <label for="last_name" class="col-sm-4 col-form-label text-md-right text-grey-dark">Last Name:<span class="text-red text-lg">*</span></label>
                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ $last_name }}">

                    @include('errors._field', [
                        'field' => 'last_name',
                    ])
                </div>
            </div>

            <!-- Specialty -->
            <div class="form-group row p-3 xl:w-4/5">
                <label for="specialty" class="col-sm-4 col-form-label text-md-right text-grey-dark">Specialty:<span class="text-red text-lg">*</span></label>
                <div class="col-sm-8 px-6">
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
            <div class="form-group row p-3 xl:w-4/5">
                <label for="license" class="col-sm-4 col-form-label text-md-right text-grey-dark">License:<span class="text-red text-lg">*</span></label>
                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="license" name="license" placeholder="License" value="{{ $license }}">

                    @include('errors._field', [
                        'field' => 'license',
                    ])
                </div>
            </div>

            <!-- Biography -->
            <div class="form-group row p-3 xl:w-4/5">
                <label for="biography" class="col-sm-4 col-form-label text-md-right text-grey-dark">Biography:<span class="text-red text-lg">*</span></label>
                <div class="col-sm-8 px-6">
                    <textarea name="biography" id="biography" class="form-control" cols="30" rows="3" placeholder="biography">{{ $biography }}</textarea>

                    @include('errors._field', [
                        'field' => 'biography',
                    ])
                </div>
            </div>

            <!-- Color -->
            <div class="form-group row p-3 xl:w-4/5">
                <label for="color" class="col-sm-4 col-form-label text-md-right text-grey-dark">Color:<span class="text-red text-lg">*</span></label>
                <div class="col-sm-8 px-6">
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
            <div class="form-group row p-3 xl:w-4/5">
                <label for="app_slot" class="col-sm-4 col-form-label text-md-right text-grey-dark">Appointment Slot:<span class="text-red text-lg">*</span></label>
                <div class="col-sm-8 px-6">
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

            <!-- User -->
            {{-- <div class="form-group row p-3 xl:w-4/5">
                <label for="user_id" class="col-sm-4 col-form-label text-md-right text-grey-dark">Available User:</label>
                <div class="col-sm-8 px-6">
                    <select name="user_id" id="user_id" class="form-control" >
                        <option value="">Select a user</option>

                        @if ( Request::is('doctors/create/*'))
                            <option value="{{ $user->id }}" selected>
                                {{ $user->email }}
                            </option>
                        @else
                            @foreach ($available_users as $user)
                                <option value="{{ $user->id }}"
                                    {{ getSelected($user->id, $userId) }}
                                >
                                    {{ $user->email }}
                                </option>
                            @endforeach
                        @endif
                    </select>

                    @include('errors._field', [
                        'field' => 'user_id',
                    ])
                </div>
            </div> --}}

        </div>

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
