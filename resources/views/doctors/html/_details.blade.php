<div class="flex justify-between text-teal-light mb-4">
    <i class="fa fa-circle-o"></i>
    <i class="fa fa-circle-o"></i>
</div>

<hr class="mt-2">

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">ID</span>
    <span class="text-grey">{{ $doctor->id }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Name</span>
    <span class="text-grey">{{ $doctor->title_name }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Specialty</span>
    <span class="text-grey">{{ $doctor->specialty }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">License</span>
    <span class="text-grey">{{ $doctor->hasLicense() ? $doctor->formatted_license : '-' }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Image</span>
    <span><img src="{{ asset($doctor->image->asPath()) }}" alt="" class="w-3/5"></span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Biography</span>
    <span class="text-grey w-2/5">
        @if ($doctor->hasBiography())
            <a data-toggle="collapse" href="#doctorBiography" role="button"
            aria-expanded="false" aria-controls="doctorBiography"
            class="text-teal-light font-bold hover:text-teal-dark">
                View more
            </a>
            <div class="collapse" id="doctorBiography">
              <div class="card card-body border-none px-0 pb-0 pt-1">
                {{ $doctor->biography }}
              </div>
            </div>
        @else
            -
        @endif
    </span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Joined</span>
    <span class="text-grey">{{ $doctor->created_at }}</span>
</div>

<div class="row px-3 my-2">
    <span class="text-grey-darkest w-1/5">User</span>

    @if ($doctor->hasUser())
        <div class="flex items-center">
            <a href="{{ route('users.show', $doctor->user) }}"
            class="text-teal-light hover:text-teal-dark font-bold mr-3">
                {{ $doctor->user->email }}
            </a>

            <a href="{{ route('users.edit', $doctor->user) }}"
            class="btn text-white rounded bg-teal-light
            hover:bg-teal-dark border border-teal mt-1 h-auto">
                <span data-feather="{{ $doctor->hasUser() ? 'edit' : 'paperclip' }}"></span>
            </a>

            <form action="{{ route('doctors.users.destroy', $doctor) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="btn text-white rounded bg-red-light
                    hover:bg-red-dark border border-red ml-2 mt-1">
                    <span data-feather="trash-2"></span>
                </button>
            </form>
        </div>
    @else
        <a href="{{ route('doctors.users.create', $doctor) }}"
        class="btn text-grey-darker bg-grey-lightest font-bold
        border-grey-dark hover:text-grey-darkest hover:bg-grey-light">
            Create User
        </a>
    @endif
</div>
