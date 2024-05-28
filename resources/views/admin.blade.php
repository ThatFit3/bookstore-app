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
                        <form method="POST" action="/admin" enctype="multipart/form-data" class="w-100 flex flex-col gap-y-2">
                            @csrf
                            <div class="w-[430px] max-w-full h-fit">
                                <label class="ms-3 text-lg">Title:</label><br>
                                <input type="text" name="title" class="text-black text-sm rounded-lg focus:shadow-sm w-full p-2 px-4">
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <label class="ms-3 text-lg">Author:</label><br>
                                <input type="text" name="author" class="text-black text-sm rounded-lg focus:shadow-sm w-full p-2 px-4">
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <label class="ms-3 text-lg">Synopsis:</label><br>
                                <textarea name="synopsis" id="" rows="5"  class="text-black text-sm rounded-lg focus:shadow-sm w-full p-2 px-4"></textarea>
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <label class="ms-3 text-lg">Type:</label><br>
                                <select name="type" class="text-black text-sm rounded-lg focus:shadow-sm w-full p-2 px-4">
                                    @foreach($types as $type)
                                        <option value="{{ $type['id'] }}">{{ $type['type_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <label class="ms-3 text-lg">Genre:</label><br>
                                <select name="genre" class="text-black text-sm rounded-lg focus:shadow-sm w-full p-2 px-4">
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre['id'] }}">{{ $genre['genre_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-[430px] max-w-full h-fit">
                                <label class="ms-3 text-lg">Cover:</label><br>
                                <input type="file" name="cover" class="text-black text-sm rounded-lg focus:shadow-sm w-full p-2 px-4 bg-white">
                            </div>
                            <button class="px-4 py-3 bg-[blue] rounded-md w-fit my-2">
                                + Add book
                            </button>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
