<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <h2 class="text-2xl">Add a new book</h2>
                    <div class="mt-6">
                        <form method="POST" action="/admin" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            <div class="w-[430px] max-w-full h-fit">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input type="text" id="title" name="title" class="mt-1 block w-full" autocomplete="off" />
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <x-input-label for="author" :value="__('Author')" />
                                <x-text-input type="text" id="author" name="author" class="mt-1 block w-full" autocomplete="off" />
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <x-input-label for="synopsis" :value="__('Synopsis')" />
                                <x-text-area name="synopsis" id="synopsis" rows="5" class="mt-1 block w-full"></x-text-area>
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <x-input-label for="type" :value="__('Type')" />
                                <x-selector name="type" id="type"  class="mt-1 block w-full">
                                    @foreach($types as $type)
                                        <option value="{{ $type['id'] }}">{{ $type['type_name'] }}</option>
                                    @endforeach
                                </x-selector>
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <x-input-label for="genre" :value="__('Genre')" />
                                <x-selector name="genre" id="genre" class="mt-1 block w-full">
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre['id'] }}">{{ $genre['genre_name'] }}</option>
                                    @endforeach
                                </x-selector>
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <x-input-label for="cover" :value="__('Synopsis')" />
                                <x-text-input type="file" id="cover" name="cover" class="mt-1 block w-full" />
                            </div>
                            <x-primary-button>
                                + Add book
                            </x-primary-button>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
