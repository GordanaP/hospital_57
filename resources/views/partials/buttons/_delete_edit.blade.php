<div class="flex">

    <form action="{{ route($name.'.destroy', $parameter) }}" method="POST">

        @csrf
        @method('DELETE')

        <button type="submit" class="btn button-delete py-2 mr-1"
            onclick="return confirm('Are you sure you want to delete the record?')">
            <span data-feather="trash-2"></span>
        </button>

    </form>

    <a href="{{ route($name.'.edit', $parameter) }}" class="btn button-edit ml-1">
        <span data-feather="edit"></span>
    </a>

</div>