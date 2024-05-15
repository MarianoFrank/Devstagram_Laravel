@extends('layouts.app')


@section('content')
    @if (isset($users) && $users->count() > 0)
        <div class="grid gap-10 grid-cols-1 md:grid-cols-2  lg:grid-cols-3">
            @foreach ($users as $user)
                <a class=" py-10 flex items-center gap-10" href="{{ route('posts.index', $user->username) }}">
                    @if (!empty($user->image))
                        <img src="{{ asset('storage') . '/' . $user->image }}" class="md:w-8/12 lg:w-6/12 rounded-full">
                    @else
                        <div class="md:w-8/12 lg:w-6/12 ">
                            <img src="{{ asset('img/usuario.svg') }}">
                        </div>
                    @endif
                    <h2>{{ $user->username }} <span class="text-gray-400">({{ $user->name }})</span></h2>
                </a>
            @endforeach
        </div>
    @else
        <h2>No hay resultados para la busqueda: {{ $query }}</h2>
    @endif
@endsection
