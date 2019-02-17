<div class="bg-teal-lighter h-14 p-3 flex items-center">
    <h5>
        <a href="{{ route('welcome') }}" class="text-white">
            {{ config('app.name') }}
        </a>
    </h5>
</div>

<div class="bg-sidebar p-3 h-screen">
    <ul class="nav flex-column">
        <li class="nav-item text-base py-2">
            <a href="#" class="hover:text-blue-lighter active">
                <span data-feather="home" class="mr-2"></span> Dashboard
                <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item text-base py-2">
            <a href="{{ route('users.index') }}" class="hover:text-blue-lighter">
                <span data-feather="users" class="mr-2"></span> Users
            </a>
        </li>
        <li class="nav-item text-base py-2">
            <a href="{{ route('doctors.index') }}" class="hover:text-blue-lighter">
                <span data-feather="disc" class="mr-2"></span> Doctors
            </a>
        </li>
        <li class="nav-item text-base py-2">
            <a href="{{ route('patients.index') }}" class="hover:text-blue-lighter">
                <span data-feather="activity" class="mr-2"></span>
                Patients
            </a>
        </li>
        <li class="nav-item text-base py-2">
            <a href="{{ route('absences.index') }}" class="hover:text-blue-lighter">
                <span data-feather="external-link" class="mr-2"></span>
                Abscences
            </a>
        </li>
        <li class="nav-item text-base py-2">
            <a href="{{ route('appointments.index') }}" class="hover:text-blue-lighter">
                <span data-feather="calendar" class="mr-2"></span>
                Appointments
            </a>
        </li>
    </ul>
</div>
