@extends('layouts.app')

@section('titulo')
    - Publicar
@endsection

@push('styles')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <form action="/post/imagen-tmp" class="dropzone">
        @csrf
    </form>

    <form class="space-y-6" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="descripcion">Descripcion (requerida)</label>
            <x-text-area name="descripcion" placeholder="Descripcion aqui..." id="descripcion" />

        </div>

        <input type="hidden" name="imagenes" value="{{old("imagenes")}}">

        <x-button type="submit" value="Publicar" />

    </form>
@endsection

@push('scripts')
    @vite('resources/js/dropzonePost.js')
@endpush