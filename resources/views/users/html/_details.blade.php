
<div class="flex justify-between text-teal-light mb-4">
    <i class="fa fa-circle-o"></i>
    <i class="fa fa-circle-o"></i>
</div>

<hr class="mt-2">

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">ID</span>
    <span class="text-grey">{{ $user->id }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Name</span>
    <span class="text-grey">{{ $user->name }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Email</span>
    <span class="text-grey">{{ $user->email }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Created</span>
    <span class="text-grey">{{ $user->created_at }}</span>
</div>

<div class="row p-3">
    <span class="text-grey-darkest w-1/5">Doctor</span>

    <span class="text-grey">
        @if ($user->hasDoctor())
            <span class="flex items-center">
                <a href="{{ route('doctors.show', $user->doctor) }}"
                class="text-teal-light hover:text-teal-dark font-bold mr-3">
                    <span class="mr-3">
                        {{ $user->doctor->title_name }}
                    </span>
                </a>

                <form action="{{ route('users.doctors.destroy', $user) }}" method="POST">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Detach</button>
                </form>
            </span>
        @else
            <a href="{{ route('users.doctors.create', $user) }}"
            class="btn text-grey-darker bg-grey-lightest font-bold
            border-grey-dark hover:text-grey-darkest hover:bg-grey-light">
                Create Doctor
            </a>
        @endif
    </span>
</div>
