@push('styles')
    @vite('resources/css/like-button.css')
@endpush

<div class="middle-wrapper">
    <div class="like-wrapper">
        <a class="like-button">
            <span class="like-icon">
                <div class="heart-animation-1"></div>
                <div class="heart-animation-2"></div>
            </span>
        </a>
    </div>
</div>
@push('scripts')
    @vite('resources/js/like-button.js')
@endpush
