@extends('layouts.app')


@push('styles')
    @vite('resources/css/swiper.css')
@endpush

@section('content')
    <div class="mx-auto container-xl md:flex gap-5 py-10">

        <div class="md:w-2/3">
            <div class="w-fit h-fit swiper">
                <div class="swiper-wrapper ">
                    @foreach (json_decode($post->image) as $imagen)
                        <img class="swiper-slide " src="{{ asset('uploads') . '/' . $imagen }}">
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev">
                </div>
                <div class="swiper-button-next"></div>
            </div>
            <p class="py-3">0 Likes</p>
            <div class="flex py-2 gap-2">
                <a class="font-bold"
                    href="{{ route('posts.index', $post->user->username) }}">{{ $post->user->username }}</a>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
            </div>

            {{ $post->description }}

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                        @method("DELETE")
                        @csrf
                        <button type="submit"
                            class="text-red-500 font-bold pt-5 flex items-center gap-1 justify-center">Eliminar publicacion<i
                                class="bi bi-trash-fill"></i></button>
                    </form>
                @endif
            @endauth

        </div>

        {{-- Comentarios --}}
        <div class="md:w-1/3 flex flex-col md:mt-0 mt-5">

            <div>
                @if ($post->comments->count() > 0)
                    <h2 class="text-xl font-bold mb-5">Comentarios</h2>
                    <div class=" overflow-auto max-h-[40rem]">
                        @foreach ($post->comments->load('user') as $comment)
                            <div class="py-2 text-sm pr-3">
                                <a href="{{ route('posts.index', $comment->user->username) }}" class="font-bold">
                                    {{ $comment->user->username }}
                                </a>
                                <p>{{ $comment->content }}</p>
                                <p class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class=" text-xs text-gray-400 text-center">Aún no hay comentarios</p>
                @endif

            </div>

            @auth
                <form class="flex gap-2 h-fit w-full py-5"
                    action="{{ route('comments.store', ['user' => $user->username, 'post' => $post->id]) }}" method="POST">
                    @csrf
                    <div class=" w-full">
                        <textarea name="comentario" class="block resize-none h-auto rounded-md p-2 border w-full"
                            style="@error('comentario')
                    border-color:red;
                     @enderror"
                            placeholder="Agreaga un comentario...">{{ old('comentario') }}</textarea>
                        @error('comentario')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                    <button type="submit" class="w-fit text-xl border p-2 rounded-md h-fit hover:bg-slate-200"><i
                            class="bi bi-send"></i></button>
                </form>

            @endauth

        </div>
    </div>
@endsection



@push('scripts')
    @vite('resources/js/swiperPost.js')
@endpush
