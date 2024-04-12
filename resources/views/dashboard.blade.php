@extends('layouts.app')

@section('titulo')
    <h1 class="text-bold text-xl my-5">
        Dashboard
    </h1>
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/usuario.svg') }}">
            </div>
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <p class="text-2xl">{{ auth()->user()->username }}</p>
            </div>
        </div>
    </div>
@endsection
