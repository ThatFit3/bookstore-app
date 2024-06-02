<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>{{ $book->title }}</h1>
                    <h1>{{ $book->author }}</h1>
                    <h1>{{ $book->type->type_name }}</h1>
                    <h1>{{ $book->genre->genre_name }}</h1>
                    <h1>{{ $book->synopsis }}</h1>
                    <select name="from" id="shopSelect">
                        @if(count($book->shopItem) == 0)
                            <option value="none" selected disabled>no shop sell this book yet</option>
                        @else
                            <option value="none" selected disabled>Select a shop</option>
                            @foreach($book->shopItem as $shop)
                            <option value="{{ $shop->id }}" data-price="{{ $shop->price }}">{{ $shop->shop->shop_name }}</option>
                            @endforeach
                        @endif
                    </select>
                    <h1 id="price"></h1>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('shopSelect').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            
            var price = selectedOption.getAttribute('data-price');
            
            document.getElementById('price').textContent = price ? 'Price: RM' + price : '';
        });
    </script>
</x-app-layout>