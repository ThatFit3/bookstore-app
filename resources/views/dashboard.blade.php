<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 py-8 text-gray-900 dark:text-gray-100 flex gap-10 justify-center">
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
</x-app-layout>
