<div>
    <input wire:model="search" wire:keydown.debounce.1000ms="findProfile('{{ $search }}')" type="text" name="search" id="search" class="border border-gray-300 border-solid text-center"
        placeholder="Search">

        @if ($results!=null)
        <ul class=" absolute mt-2 w-auto bg-white p-1 shadow-lg border border-gray-500 border-solid z-10">
            @foreach ($results as $profile)
            <li class="flex flex-row items-center justify-between my-1">
                <a href="/{{ $profile['username'] }}" class="font-bold text-blue-500 hover:underline">
                <img src="{{ $profile['profile_photo_url'] }}" class="rounded-full h-10 w-100 me-24">
            </a>
            <span>
                <a href="/{{ $profile['username'] }}" class="font-bold text-blue-500 hover:underline">{{ $profile['username'] }}</a>
            </span>
            </li>
            @if (!$loop->last)
            <hr class="h-2">
            @endif
            @endforeach
        </ul>

        @endif
</div>
