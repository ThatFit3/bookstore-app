<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" id="header"> 
                {{ __('Dashboard') }}
            </h2>
            <form action="/dashboard" method="GET" id="search-form" class="hidden w-full items-center">
                <x-text-input type="text" name="search" placeholder="Search" class="w-full me-5 h-full" />
                <x-primary-button class="me-5 h-full">
                    Search
                </x-primary-button>
            </form>
            <ion-icon name="search-outline" class="text-xl cursor-pointer" id="search"></ion-icon>
            <ion-icon name="close-outline" class="text-xl cursor-pointer hidden" id="cancel"></ion-icon>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 py-8 text-gray-900 dark:text-gray-100">
                    
                    <div class="flex gap-10 justify-center mt-6">
                    @foreach($books as $book)
                        <x-card 
                            image="{{ $book->image }}" 
                            link="books/{{ $book->id }}" 
                            title="{{ $book->title }}"
                            author="{{ $book->author }}"
                            type="{{ $book->type->type_name }}"
                            genre="{{ $book->genre->genre_name }}"
                            >
                        </x-card>                        
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('click', function() {
            var searchForm = document.getElementById('search-form');
            var header = document.getElementById('header');
            var search = document.getElementById('search');
            var cancel = document.getElementById('cancel');

            search.classList.toggle('hidden');
            cancel.classList.toggle('hidden');
            searchForm.classList.toggle('hidden');
            searchForm.classList.toggle('flex');
            header.classList.toggle('hidden');
        });
        document.getElementById('cancel').addEventListener('click', function() {
            var searchForm = document.getElementById('search-form');
            var header = document.getElementById('header');
            var search = document.getElementById('search');            
            var cancel = document.getElementById('cancel');


            cancel.classList.toggle('hidden');
            search.classList.toggle('hidden');
            searchForm.classList.toggle('hidden');
            searchForm.classList.toggle('flex');
            header.classList.toggle('hidden');
        });
    </script>
</x-app-layout>
