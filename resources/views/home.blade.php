@extends('layouts.app')

@push('styles')
    @vite('resources/css/swiper.css')
@endpush

@section('content')
    @forelse ($posts as $post)
        <div class=" my-10 max-w-[40rem] mx-auto">
            <a class="flex gap-2 items-center py-4" href="{{ route('posts.index', $post->user->username) }}">
                @if (empty($post->user->image))
                    <div class="rounded-full h-10 w-10 bg-slate-400 flex justify-center items-center text-white text-2xl">
                        <i class="bi bi-person-fill"></i>
                    </div>
                @else
                    <img src="{{ asset('storage') . '/' . $post->user->image }}" class="rounded-full h-10 w-10">
                @endif

                <p>{{ $post->user->username }}</p>
            </a>

            <div class="w-fit h-fit swiper rounded-md">
                <div class="swiper-wrapper ">
                    @foreach (json_decode($post->image) as $imagen)
                        <img class="swiper-slide " src="{{ asset('storage') . '/' . $imagen }}">
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev">
                </div>
                <div class="swiper-button-next"></div>
            </div>

            <div class="my-4">
                <h3 class=" font-bold text-md">Comentarios</h3>
                @foreach ($post->comments as $comment)
                    <div class="py-2 text-sm pr-3">
                        <a href="{{ route('posts.index', $comment->user->username) }}" class="font-bold">
                            {{ $comment->user->username }}
                        </a>
                        <p>{{ $comment->content }}</p>
                        <p class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
                <a class="text-blue-500"
                    href="{{ route('posts.show', ['user' => $post->user->username, 'post' => $post->id]) }}">Ver
                    más...</a>
            </div>





        </div>
    @empty
        <p class=" text-center text-md">Las personas que siguen aún no subieron posts.</p>
    @endforelse
@endsection


@push('scripts')
    @vite('resources/js/swiperPost.js')
@endpush
