@extends('layouts.app')

@section('titulo')
    - Publicar
@endsection

@section('content')
    <form class="space-y-6" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-drag-and-drop/>

        <div>
            <label for="descripcion">Descripcion (requerida)</label>
            <x-text-area name="descripcion" placeholder="Descripcion aqui..." id="descripcion" />
        
        </div>

        <x-button type="submit" value="Publicar" />

    </form>
@endsection
