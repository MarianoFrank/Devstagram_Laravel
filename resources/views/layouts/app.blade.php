<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">

    {{-- Icons Boostrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @stack("styles")

    @vite('resources/css/app.css')

    <title>DevStagram @yield('titulo')</title>
</head>

<body class=" text-slate-900 font-semibold text-md min-h-screen flex flex-col">
    @session('alert')
    <div class="p-2 fixed rounded top-20 left-1/2 -translate-x-1/2 text-bold text-zinc-50
    @if ($value["type"]==="error")
        bg-red-600
    @elseif ($value["type"]==="success")
        bg-green-600
    @else
        bg-blue-600
    @endif
    ">
        {{ $value['msg'] }}
    </div>
@endsession

    @include('layouts.header')

    <main class="text-sm flex-grow @if (!isset($container) || $container) w-[90%] max-w-screen-lg mx-auto @endif">
        

        @yield('content')
    </main>

    @include('layouts.footer')


    @vite('resources/js/app.js')
    
    @stack("scripts")
</body>

</html>
