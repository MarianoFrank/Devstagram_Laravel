@extends('layouts.app')

@push('styles')
    @vite('resources/css/swiper.css')
@endpush

@section('content')
    <x-listar-post :posts="$posts" />
@endsection


@push('scripts')
    @vite('resources/js/swiperPost.js')
@endpush
