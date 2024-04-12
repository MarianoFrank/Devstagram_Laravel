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

    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body class=" text-slate-900 font-semibold text-md min-h-screen flex flex-col">
    @include('components.header')

    <main class="text-sm flex-grow @if (!isset($container) || $container) w-[90%] max-w-screen-lg mx-auto @endif">
        <h1 class="text-bold text-3xl mb-5">
            @yield('titulo')
        </h1>

        @yield('content')
    </main>

    @include('components.footer')

</body>

</html>
