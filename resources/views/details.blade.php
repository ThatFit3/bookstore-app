<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="/dashboard">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2 cursor-pointer" id="header">
                <ion-icon name="chevron-back-outline"></ion-icon>Back
                </h2>
            </a>
            @if(Auth::user()->is_admin == 1)
            <div class="flex gap-3 items-center">
            <x-primary-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal' , 'edit-{{ $book->id }}')">Edit</x-primary-button>
                <x-modal name="edit-{{$book->id}}" focusable>
                    <div class="p-6 text-left">
                        <h2 class="text-2xl">Edit @entityDecode($book->title)</h2>
                        <div class="mt-6">
                            <form method="POST" action="/admin/{{$book->id}}" enctype="multipart/form-data" class="mt-6 space-y-6">
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
                                <x-secondary-button>
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
                        <form method="POST" action="/admin/{{$book->id}}">
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
            </div>
            @endif
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex text-gray-900 dark:text-gray-100 flex-wrap">
                    <div class="w-full md:w-[30%] p-5">
                        <div class="p-3 bg-gray-100 dark:bg-gray-900 rounded-lg">
                            <img src="{{ '../' . $book->image }}" alt="" class="w-full rounded-t-md" />
                            <x-primary-button class="mt-2 w-full rounded-t-none"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal' , 'purchase')">
                                <h1 class="text-center w-full">Buy</h1>
                            </x-primary-button>
                        </div>

                        <x-modal name="purchase" focusable>
                            <div class="p-6">
                                <form method="POST" action="/purchase/{{ $book->id }}" class="flex gap-3 flex-col">
                                    @csrf
                                    <div>
                                        <x-input-label for="shopSelect" :value="__('Select where you want to buy this book from')" />
                                        <x-selector name="shop" idvalue="shopSelect" class="mt-2">
                                            @if(count($book->shopItem) > 0)
                                            <option value="0" disabled selected>Select a shop</option>
                                            @foreach($book->shopItem as $shopItem)
                                            <option value="{{ $shopItem->id }}" data-price="{{ $shopItem->price }}">{{ $shopItem->shop->shop_name }} - RM {{ $shopItem->price }}</option>
                                            @endforeach
                                            @else
                                            <option value="0" disabled selected>There are no shop that sell this book</option>
                                            @endif
                                        </x-selector>
                                    </div>
                                    <div>
                                        <x-input-label for="quantity" :value="__('Quantity')" />
                                        <div class="flex gap-3 items-center mt-2">
                                            <x-primary-button type="button" class="aspect-square" idValue="minus"><ion-icon name="remove-outline"></ion-icon></x-primary-button>
                                            <x-text-input type="number" name="quantity" id="quantity" value="1" class="w-fit h-fit"/>
                                            <x-primary-button type="button" class="aspect-square" idValue="add"><ion-icon name="add-outline"></ion-icon></x-primary-button>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex justify-end">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>
        
                                        <x-primary-button class="ms-3 hidden" idValue="submit">
                                            Buy
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </x-modal>
                    </div>
                    <div class="max-h-full w-full md:w-[70%] p-8 pt-10">
                        <div class="overflow-auto">
                            <h1 class="font-bold text-3xl">{{ html_entity_decode($book->title) }}</h1>
                            <h1 class="text-lg my-0 font-light italic mb-5">by: {{ $book->author }}</h1>
                            <h1 class="mb-5">{!! nl2br(html_entity_decode(e($book->synopsis))) !!}</h1>    
                            <p>Type: {{ $book->type->type_name }}</p>
                            <p>Genre: {{ $book->genre->genre_name }}</p>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-7">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex-wrap px-10">
                    <div class="flex justify-between items-center">
                        <h1 class="text-2xl">{{ $ur_review ? "Your review:" : "Write your review" }}</h1>
                        @if($ur_review)
                        <div class="flex gap-x-2">
                            <x-danger-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal' , 'delete')">
                                Delete
                            </x-danger-button>
                            <x-primary-button idValue="edit" type="button">Edit</x-primary-button>
                        </div>

                        <x-modal name="delete" focusable>
                            <form method="POST" action="/review/{{ $book->id }}" class="p-6">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="review_id" value="{{ $ur_review->id }}">
                                <p>Are you sure you want to delete this review?</p>
                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ms-3">
                                        Delete
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                        @endif
                    </div>

                    <div class="mt-4">
                        @if(!$ur_review)
                        <form method="POST" action="/review/{{ $book->id }}" class="mt-6 space-y-3">
                            @csrf
                            <div class="w-[780px] max-w-full h-fit flex items-center gap-x-1">                                
                                <p>Rating:</p>
                                <x-text-input type="number" id="rating" name="rating" class="mt-1 block w-[40px]" autocomplete="off" min="1" max="10" />
                                <x-input-label for="rating" :value="__('/10')" />
                            </div>
                            <div class="w-[780px] max-w-full h-fit flex items-center gap-x-2">                                
                                <x-text-area placeholder="Write your thoughts of the book here" rows="7" name="review"></x-text-area>
                            </div>
                            <x-primary-button>
                                Submit
                            </x-primary-button>
                        </form>
                        @else
                        <div class="">
                            <div class="w-full hidden" id="edit-area">
                                <form method="POST" action="/review/{{ $book->id }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="review_id" value="{{ $ur_review->id }}">
                                    <div class="flex gap-2 flex-col">
                                        <div class="flex items-center justify-between">
                                            <p class="text-lg">Edit your review:</p>
                                            <ion-icon name="close-outline" class="text-3xl cursor-pointer me-3" id="cancel"></ion-icon>
                                        </div>
                                        <div class="w-[780px] max-w-full h-fit flex items-center gap-x-1">                                
                                            <p>Rating:</p>
                                            <x-text-input type="number" id="rating" name="rating" class="mt-1 block w-[40px]" autocomplete="off" min="1" max="10" value="{{ $ur_review->rating }}" />
                                            <x-input-label for="rating" :value="__('/10')" />
                                        </div>
                                        <div class="w-[780px] max-w-full h-fit flex items-center gap-x-2">                                
                                            <x-text-area placeholder="Write your thoughts of the book here" rows="7" name="review" :value="$ur_review ? trim($ur_review->review) : ''" ></x-text-area>
                                        </div>
                                        <x-primary-button class="w-fit">
                                            Edit
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                            <div class="w-full" id="text">
                                <div class="relative flex ms-[30px] mt-10 p-6 border-2 dark:border-white border-black w-fit rounded-lg">
                                    <div class="dark:bg-white dark:text-black bg-black text-white p-5 py-2 mb-6 w-fit absolute rounded-xl top-[-30px] left-[-25px]">
                                        <h6 class="text-lg">Rating: {{ $ur_review->rating }}/10</h6>
                                    </div>
                                <p>{!! nl2br(e($ur_review->review)) !!}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>  

                    <div class="mt-10 flex justify-center">
                        <hr class="h-[1px] w-full bg-gray-900 dark:bg-white">
                    </div>
                    <div class="mt-6">
                        @if($review_count > 0)
                            <h1 class="text-2xl">Others' opinion</h1>
                            @foreach($book->review as $review)
                                @if($review->user->id !== Auth::user()->id)
                                <div class="w-[780px] max-w-full mt-14">
                                    <div class="w-fit max-w-full flex flex-col gap-y-1 relative ms-[25px]">
                                        <div class="absolute left-[-25px] top-[-33px] p-3 px-5 bg-black text-white dark:bg-white dark:text-black rounded-full">
                                            {{ $review->user->name }}
                                        </div>
                                        <div class="dark:border-white border-black border-2 rounded-t-xl p-4">
                                            <h1 class="text-lg font-bold">Raitng: {{ $review->rating }}</h1>                                            
                                        </div>
                                        <div class="dark:border-white border-black border-2 rounded-b-xl p-4">
                                            {!! nl2br(e($review->review)) !!}
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        @elseif($ur_review)
                            <h1 class="text-2xl">No one other than you has write a review on this book</h1>
                        @else
                            <h1 class="text-2xl">There's no review on this book</h1>
                        @endif
                    </div>
                </div>    
            </div>
        </div>
    </div>

    <script>
        const shopSelect = document.getElementById('shopSelect');
        const submitButton = document.getElementById('submit');
        shopSelect.addEventListener('change', function() {
            console.log(this.value);
            if (this.value > 0) {
                submitButton.classList.remove('hidden');
            } else {
                submitButton.classList.add('hidden');
            }
        });
        document.getElementById('add').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
            console.log(quantityInput.value);
        });

        document.getElementById('minus').addEventListener('click', function() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) { // Ensure the quantity does not go below 1
                quantityInput.value = currentValue - 1;
            }
        });
        document.getElementById('edit').addEventListener('click', function() {
            var text = document.getElementById('text');
            var editArea = document.getElementById('edit-area');

            text.classList.toggle('hidden');
            editArea.classList.toggle('hidden');
        });
        document.getElementById('cancel').addEventListener('click', function() {
            var text = document.getElementById('text');
            var editArea = document.getElementById('edit-area');

            text.classList.toggle('hidden');
            editArea.classList.toggle('hidden');
        });
    </script>
</x-app-layout>