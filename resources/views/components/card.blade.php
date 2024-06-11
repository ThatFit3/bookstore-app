@props(['image' , 'link', 'title', 'author', 'type', 'genre'])

<div class="w-[38%] md:w-[27%] lg:w-[17%]">
    <a href="{{ $link }}">
        <div class="w-full aspect-[1/1.5] flex">
            <img src="{{ $image }}" alt="">
        </div>
    </a>

    <div>
        <a href="{{ $link }}">
            <h1 class="text-xl mb-0 font-medium">{{ $title }}</h1>
        </a>
        <h1 class="text-md my-0 font-light">by: {{ $author }}</h1>
        <p class="text-md">{{ $type }}, {{ $genre }}</p>
    </div>
</div>