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

    <section class="container mx-auto mt-10">
        @if (isset($posts) && $posts->count() > 0)
            <h2 class="text-center font-bold my-10">Publicaciones</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($posts as $post)
                    <a href="{{ route('posts.show', ["user"=> $user->username , "post"=> $post->id]) }}">
                        <img src="{{ asset('uploads') . '/' . json_decode($post->image)[0] }}">
                    </a>
                @endforeach
            </div>

            <div class="my-5">{{ $posts->links('pagination::tailwind') }}</div>
        @else
            <p class="text-gray-600 text-sm text-center">No hay publicaciones aún</p>
        @endif

    </section>
@endsection
