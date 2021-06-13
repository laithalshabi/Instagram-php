<div class="flex flex-col" id="sec3">
    <div class="flex flex-col items-start ps-4 pb-1">
        <div class="flex flex-row items-center">
            <button class="text-2xl me-3 focus:outline-none" wire:model="like-button"
                wire:click="ToggleLike({{ $post_id }})"><i
                    class="{{ $isLiked ? "fas text-red-500" : "far" }} fa-heart"></i></button>
            <button class="text-2xl me-3 focus:outline-none"><i class="far fa-comment" onClick="document.getElementById('comment{{ $post_id }}').focus()"></i></button>
            <button class="text-2xl me-3 focus:outline-none"><i class="far fa-share-square" onClick="copyToClipboard({{ $post_id }})" id="{{ $post_id }}" value="{{ url('') }}/posts/{{ $post_id }}"></i></button>
        </div>
        <span>{{ __('Liked by') }} {{ $likeCount }}</span>
    </div>
</div>
