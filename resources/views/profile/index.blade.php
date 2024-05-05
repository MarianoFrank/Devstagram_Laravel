@extends('layouts.app')

@section('titulo')
    - Editar perfil
@endsection

@section('content')
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

        <div class="flex gap-2 items-center border-b pb-5">

            @if (empty(auth()->user()->image))
                <div class="rounded-full h-12 w-12 bg-slate-400 flex justify-center items-center text-white text-2xl">
                    <i class="bi bi-person-fill"></i>
                </div>
            @else
                <img src="{{ asset('storage') . '/' . auth()->user()->image }}" class="rounded-full h-12 w-12">
            @endif

            <x-button value="Cambiar" style=2 id="btnUploadAvatar" />

            <form action="{{ route('avatar.store') }}" method="POST" id="formAvatar" enctype="multipart/form-data">
                @csrf
                <input type="file" style="display: none" id="avatarFile" name="avatar">
            </form>

            @error("avatar")
                <p class="text-red-600">{{$message}}</p>
            @enderror
        </div>

        <form class="space-y-6" action="{{ route('profile.store') }}" method="POST">
            @csrf

            <div>
                <label for="username">Username</label>
                <x-input-text name="username" type="text" value="{{ auth()->user()->username }}" />
            </div>

            <div>
                <button type="submit"
                    class="flex  justify-center rounded-md bg-primario-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-primario-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primario-600">Ingresar</button>
            </div>
        </form>
    </div>
@endsection


@push('scripts')
    @vite('resources/js/avatarUpload.js')
@endpush
