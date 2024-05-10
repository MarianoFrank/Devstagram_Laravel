@extends('layouts.app')

@section('titulo')
    {{ $user->username }}
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col md:flex-row gap-5">
            @if (!empty($user->image))
                <img src="{{ asset('storage') . '/' . $user->image }}" class="md:w-8/12 lg:w-6/12 rounded-full">
            @else
                <div class="md:w-8/12 lg:w-6/12 ">
                    <img src="{{ asset('img/usuario.svg') }}">
                </div>
            @endif

            <div class="md:w-8/12 lg:w-6/12  flex flex-col gap-1">
                <div class="flex items-center">
                    <p class="text-2xl">{{ $user->username }}</p>
                    @auth
                        @if ($user->username === auth()->user()->username)
                            <a href="{{ route('profile.index') }}" class="text-xl hover:text-gray-400 p-2"><i
                                    class="bi bi-gear-fill"></i></a>
                        @endif
                    @endauth
                </div>


                <div class="flex flex-col mt-2">
                    <div class="flex gap-1">

                        <p id="countFollows" class="font-bold">{{ $user->followers()->count() }}</p><span
                            class="font-normal">Seguidores</span>

                    </div>

                    <p class="font-bold">{{ $user->followings()->count() }} <span class="font-normal">Siguiendo</span></p>
                    <p class="font-bold">{{ $user->posts()->count() }} <span class="font-normal">Post</span></p>
                </div>

                @if (auth()->user()->id !== $user->id)
                    @if ($user->followers->contains(auth()->user()->id))
                        <x-button style=2 value="Dejar de seguir" id="unfollow" />
                    @else
                        <x-button value="Seguir" id="follow" />
                    @endif
                @endif

            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        @if (isset($posts) && $posts->count() > 0)
            <h2 class="text-center font-bold my-10">Publicaciones</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($posts as $post)
                    <a href="{{ route('posts.show', ['user' => $user->username, 'post' => $post->id]) }}">
                        @php
                            $arrayImages = json_decode($post->image);
                        @endphp
                        @if (!empty($arrayImages))
                            <img src="{{ asset('storage') . '/' . $arrayImages[0] }}">
                        @endif
                    </a>
                @endforeach
            </div>

            <div class="my-5">{{ $posts->links('pagination::tailwind') }}</div>
        @else
            <p class="text-gray-600 text-sm text-center">No hay publicaciones aún</p>
        @endif

    </section>
@endsection


@push('scripts')
    @vite('resources/js/follow.js')
@endpush
