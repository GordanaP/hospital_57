<div class="card">
    <div class="card-body p-8 text-center flex flex-col justify-center items-center">
        <a {{ $href }} class="hover:no-underline">
            <svg style="width: 60%;" class="fill-current text-{{ $fill }} hover:text-{{ $hover }}"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="{{ $path }}"/>
            </svg>
            <h4 class="mt-10 font-bold text-grey-dark">{{ $title }}</h4>
        </a>
    </div>
</div>
