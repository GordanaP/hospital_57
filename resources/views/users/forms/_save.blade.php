<form action="{{ $route }}" method="POST">

    @csrf

    @if (request()->route()->named('users.edit'))
        @method('PUT')
    @endif

    <div class="card card-shadow w-4/5 mx-auto">
        <div class="card-body">

            <div class=" p-4 -ml-5 border-l-4 border-teal-lighter">
                <p class="text-sm text-grey-darker font-gabriela">
                    * Required fields
                </p>
            </div>

            <!-- Name -->
            <div class="form-group row xl:p-3 xl:w-4/5">
                <label for="name" class="col-sm-4 col-form-label text-md-right
                text-grey-dark">Name:<span class="text-red text-lg">*</span></label>
                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="name" name="name"
                    placeholder="User name" value="{{ $name }}">

                    @include('errors._field', [
                        'field' => 'name',
                    ])
                </div>
            </div>

            <!-- Email -->
            <div class="form-group row xl:p-3 xl:w-4/5">
                <label for="email" class="col-sm-4 col-form-label text-md-right
                text-grey-dark">E-mail address:<span class="text-red text-lg">*</span>
                </label>
                <div class="col-sm-8 px-6">
                    <input type="text" class="form-control" id="email" name="email"
                    placeholder="example@domain.com" value="{{ $email }}">

                    @include('errors._field', [
                        'field' => 'email',
                    ])
                </div>
            </div>

            <!-- Password -->
            <div class="form-group row xl:p-3 xl:w-4/5">
                <label for="password" class="col-sm-4 col-form-label text-md-right
                text-grey-dark">
                    Password: @if (request()->route()->named('users.create')
                    OR request()->route()->named('users.create.fordoctor'))
                        <span class="text-red text-lg">*</span>
                    @endif
                </label>

                <div class="col-sm-8 px-6">
                    @if (request()->route()->named('users.edit'))
                        <div class="checkbox mt-2 mb-2">
                            <label class="checkbox-container"><input type="radio"
                                class="checkitem" name="handle-password"
                                value="doNotChange" checked><span
                                class="checkmark radio-checkmark"></span></label>
                                <span class="ml-8">Do not change</span>
                        </div>
                    @endif

                    <div class="checkbox mt-2 mb-2">
                        <label class="checkbox-container"><input type="radio"
                            class="checkitem" name="handle-password" value="auto"
                            {{
                                request()->route()->named('users.create') ||
                                request()->route()->named('doctors.users.create')
                                ? 'checked' : ''
                            }}>
                            <span class="checkmark radio-checkmark"></span>
                        </label>
                        <span class="ml-8">Auto generate</span>
                    </div>

                    <div class="checkbox mt-2 mb-2">
                        <label class="checkbox-container"><input type="radio"
                            class="checkitem" name="handle-password" id="manual"
                            value="manual">
                            <span class="checkmark radio-checkmark"></span>
                        </label>
                        <span class="ml-8">Generate manually</span>
                    </div>

                    <input type="password" class="form-control mt-4 hidden"
                    id="password" name="password" placeholder="Password">

                    @include('errors._field', [
                        'field' => 'password',
                    ])
                </div>
            </div>
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