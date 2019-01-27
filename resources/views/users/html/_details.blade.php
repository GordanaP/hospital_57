<main class="card card-body card-shadow">
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
</main>