<div class="flex justify-between text-teal-light mb-4">
    <i class="fa fa-circle-o"></i>
    <i class="fa fa-circle-o"></i>
</div>

<hr class="mt-2">

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Name</span>
    <span class="text-grey">{{ $patient->full_name }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Gender</span>
    <span class="text-grey">{{ $patient->gender_name }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Birthday</span>
    <span class="text-grey">{{ $patient->birthday }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Age</span>
    <span class="text-grey">{{ $patient->age }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Address</span>
    <span class="text-grey">{{ $patient->full_address }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Phone Number</span>
    <span class="text-grey">{{ $patient->phone }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Created</span>
    <span class="text-grey">{{ $patient->created_at }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">
        Doctor
    </span>

    @if ($patient->hasDoctor())
        <div class="flex items-center">
            <a href="{{ route('doctors.show', $patient->doctor) }}"
            class="text-teal-light hover:text-teal-dark font-bold mr-3">
                {{ $patient->doctor->title_name }}
            </a>

            <a href="{{ route('patients.doctors.create', $patient) }}"
            class="btn text-white rounded bg-teal-light
            hover:bg-teal-dark border border-teal mt-1 h-auto">
                <span data-feather="edit"></span>
            </a>

            <form action="{{ route('patients.doctors.destroy', $patient) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="btn text-white rounded bg-red-light
                    hover:bg-red-dark border border-red ml-2 mt-1">
                    <span data-feather="trash-2"></span>
                </button>
            </form>
        </div>
    @else
        <a href="{{ route('patients.doctors.create', $patient) }}"
        class="btn text-grey-darker bg-grey-lightest font-bold
        border-grey-dark hover:text-grey-darkest hover:bg-grey-light">
            Add Doctor
        </a>
    @endif
</div>