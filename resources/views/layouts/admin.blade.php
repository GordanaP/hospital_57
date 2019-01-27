<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('partials.top._head')
    @yield('links')

</head>

<body class="bg-grey-lighter">
    <div id="app">

        <div class="flex">
            <aside class="w-sidebar text-white">

                @include('partials.side._adminside')

            </aside>

            <main class="w-full">

                @include('partials.top._adminnav')

                <div class="p-5 h-screen">
                    @yield('content')
                </div>

            </main>
        </div>

    </div>

    @include('partials.bottom._script')
    @yield('scripts')
</body>

</html>