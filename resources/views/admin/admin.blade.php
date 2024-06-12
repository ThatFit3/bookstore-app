<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col gap-y-2">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <x-primary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal' , 'new-book')">
                            Add a book
                        </x-primary-button>

                        <x-modal name="new-book" focusable class="p-6">
                            <div class="p-6">
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
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            Cancel
                                        </x-secondary-button>
                                    </form>
                                </div>
                            </div>
                        </x-modal>
                        <div class="flex items-center mt-3">
                            <form action="/admin" method="GET" id="search-form" class="w-full items-center flex">
                                <x-text-input type="text" name="search" placeholder="Search" class="w-full me-5 h-full" />
                                <x-primary-button class="h-full">
                                    Search
                                </x-primary-button>
                            </form>
                        </div>
                        <table class="table-auto w-full mt-6 border-collapse border border-slate-500">
                            <thead>
                                <tr class="text-left">
                                    <th class="border-collapse border border-slate-500 p-2">Id</th>
                                    <th class="border-collapse border border-slate-500 p-2">Title</th>
                                    <th class="border-collapse border border-slate-500 p-2">Cover</th>
                                    <th class="border-collapse border border-slate-500 p-2">Synopsis</th>
                                    <th class="border-collapse border border-slate-500 p-2">Type and genre</th>
                                    <th class="border-collapse border border-slate-500 p-2">Volume(s)</th>
                                    <th class="border-collapse border border-slate-500 p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                <tr class="text-left">
                                    <td class="border-collapse border border-slate-500 p-2 text-center">{{$book->id}}</td>
                                    <td class="border-collapse border border-slate-500 p-2">{{ html_entity_decode($book->title) }} <br> {{ "by: " . $book->author}}</td>
                                    <td class="border-collapse border border-slate-500 p-2"><img src="{{ $book->image }}" alt=""></td>
                                    <td class="border-collapse border border-slate-500 p-2">@entityDecode($book->synopsis)</td>
                                    <td class="border-collapse border border-slate-500 p-2">{{$book->genre->genre_name}} , {{$book->type->type_name}}</td>
                                    <td class="border-collapse border border-slate-500 p-2 text-center">{{$book->volumes}}</td>
                                    <td class="border-collapse border border-slate-500 p-2 text-center">
                                        <x-primary-button class="m-2"
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal' , 'edit-{{ $book->id }}')">Edit</x-primary-button>
                                        <x-modal name="edit-{{$book->id}}" focusable>
                                            <div class="p-6 text-left">
                                                <h2 class="text-2xl">Edit @entityDecode($book->title)</h2>
                                                <div class="mt-6">
                                                    <form method="POST" action="admin/{{$book->id}}" enctype="multipart/form-data" class="mt-6 space-y-6">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="w-[430px] max-w-full h-fit">
                                                            <x-input-label for="title" :value="__('Title')" />
                                                            <x-text-input type="text" id="title" name="title" class="mt-1 block w-full" autocomplete="off" value="{{ html_entity_decode($book->title) }}"/>
                                                        </div>
                                                        <div class="w-[430px] max-w-full h-fit">
                                                            <x-input-label for="author" :value="__('Author')" />
                                                            <x-text-input type="text" id="author" name="author" class="mt-1 block w-full" autocomplete="off" value="{{ $book->author }}" />
                                                        </div>
                                                        <div class="w-[430px] max-w-full h-fit">
                                                            <x-input-label for="synopsis" :value="__('Synopsis')" />
                                                            <x-text-area name="synopsis" id="synopsis" rows="5" class="mt-1 block w-full"><x-slot name="value">@entityDecode($book->synopsis)</x-slot></x-text-area>
                                                        </div>
                                                        <div class="w-[430px] max-w-full h-fit">
                                                            <x-input-label for="type" :value="__('Type')" />
                                                            <x-selector name="type" id="type"  class="mt-1 block w-full">
                                                                @foreach($types as $type)
                                                                    
                                                                    <option value="{{ $type['id'] }}" {{ $type->id == $book->type_id ? 'selected' : '' }}>{{ $type['type_name'] }}</option>
                                                                @endforeach
                                                            </x-selector>
                                                        </div>
                                                        <div class="w-[430px] max-w-full h-fit">
                                                            <x-input-label for="genre" :value="__('Genre')" />
                                                            <x-selector name="genre" id="genre" class="mt-1 block w-full">
                                                                @foreach($genres as $genre)
                                                                    <option value="{{ $genre['id'] }}" {{ $genre->id == $book->genre_id ? 'selected' : '' }}>{{ $genre['genre_name'] }}</option>
                                                                @endforeach
                                                            </x-selector>
                                                        </div>
                                                        <div class="w-[430px] max-w-full h-fit">
                                                            <x-input-label for="cover" :value="__('Synopsis')" />
                                                            <x-text-input type="file" id="cover" name="cover" class="mt-1 block w-full" />
                                                        </div>
                                                        <x-primary-button>
                                                            Save
                                                        </x-primary-button>
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            Cancel
                                                        </x-secondary-button>
                                                    </form>
                                                </div>
                                            </div>
                                        </x-modal>


                                        <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal' , 'delete-{{ $book->id }}')">Delete</x-danger-button>
                                        <x-modal name="delete-{{$book->id}}" focusable>
                                            <div class="p-6 text-left">
                                                <form method="POST" action="admin/{{$book->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="review_id" value="{{ $book->id }}">
                                                    <p>Are you sure you want to delete <span class="font-bold">@entityDecode($book->title)</span>?</p>
                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>
    
                                                        <x-danger-button class="ms-3">
                                                            Delete
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </x-modal>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
