@extends('layouts.app')

@section('titulo')
    {{ $user->username }}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col md:flex-row gap-5">
            <div class="md:w-8/12 lg:w-6/12 ">
                <img src="{{ asset('img/usuario.svg') }}">
            </div>
            <div class="md:w-8/12 lg:w-6/12  flex flex-col gap-1">
                <p class="text-2xl">{{ $user->username }}</p>
                <div class="flex flex-col mt-2">
                    <p class="font-bold">0 <span class="font-normal">Seguidores</span></p>
                    <p class="font-bold">0 <span class="font-normal">Siguiendo</span></p>
                    <p class="font-bold">0 <span class="font-normal">Post</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection
