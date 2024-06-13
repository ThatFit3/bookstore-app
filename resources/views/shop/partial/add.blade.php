<div class="w-full mt-6">
    <form action="/shop" class="w-full flex items-center mb-7" method="GET">
        <input type="hidden" name="include" value="add">
        <x-text-input name="search" type="text" class="w-full me-2" placeholder="Search" />
        <x-primary-button>Search</x-primary-button>
    </form>

    @foreach($books as $book)
    <div class="mt-3 flex gap-4">
        <div class="w-[20%] min-w-[180px]">
            <div class="p-3 bg-gray-100 dark:bg-gray-900 rounded-lg">
                <img src="{{ '../' . $book->image }}" alt="" class="w-full rounded-t-md" />
            </div>
        </div>
        <div>
            <div class="overflow-auto">     
                <h1 class="font-bold text-3xl">{{ html_entity_decode($book->title) }}</h1>
                <h1 class="text-lg my-0 font-light italic mb-5">by: {{ $book->author }}</h1>
                <p>Type: {{ $book->type->type_name }}</p>
                <p>Genre: {{ $book->genre->genre_name }}</p>
                <form action="/shop/{{ $shop->id }}/add" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="book" value="{{ $book->id }}" />
                    <x-text-input name="price" type="decimal" class="p-2" placeholder="Price..." />
                    <x-primary-button class="mt-6 h-full">+ Add</x-primary-button>
                </form>
            </div> 
        </div>
    </div>
    @endforeach
</div>