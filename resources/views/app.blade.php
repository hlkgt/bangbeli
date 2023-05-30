<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - BangBeli</title>
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/solid.css') }}">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @php
        $segments = request()->segments();
        $breadcrumbPath = '';
        
        foreach ($segments as $segment) {
            $breadcrumbPath .= ' / ' . $segment;
        }
    @endphp
    <div class="min-h-screen flex">
        <div class="bg-yellow-400 w-72 hidden lg:block">
            <aside class="h-screen bg-yellow-400 grid grid-cols-1 grid-rows-6 text-white px-12 font-semibold text-xl">
                <div class="row-span-1 flex items-center justify-center text-4xl">
                    <a href="{{ route('dashboard') }}">BangBeli</a>
                </div>
                <ul class="row-span-4 flex flex-col gap-6">
                    @foreach ($links as $link)
                        <li class="flex items-center gap-2"><i class="{{ 'fa-solid ' . $link->icon }}"></i><a
                                href="{{ route($link->path) }}">{{ $link->text }}</a>
                        </li>
                    @endforeach
                </ul>
                <form action="{{ route('logout') }}" method="post" class="row-span-1 flex items-center">
                    @csrf
                    <button type="submit">Log Out
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </aside>
        </div>
        <div class="w-full flex flex-col">
            <header
                class="h-20 bg-yellow-400 px-6 flex justify-between items-center font-semibold text-white capitalize">
                <div class="text-xl">{{ $breadcrumbPath }}</div>
                <p class="flex items-center gap-2"><i class="fa-solid fa-user"></i>{{ auth()->user()->name }}</p>
            </header>
            <main class="p-4 flex-1">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#close-button").click(function() {
            $("#notification").remove();
        })
    </script>
    @yield('js')
</body>

</html>
