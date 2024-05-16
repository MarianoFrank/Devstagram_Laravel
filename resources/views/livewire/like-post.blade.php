<div class="flex gap-2 items-center my-3 text-md">
    <button wire:click="like">
        <i class="bi bi-heart{{ $isLiked ? '-fill text-red-500' : '' }}"></i>
    </button>
    <p>{{ $likeCount }}</p>
</div>
