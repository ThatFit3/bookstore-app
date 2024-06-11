<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex text-gray-900 dark:text-gray-100 flex-wrap">
                    <div class="w-[30%] p-8">
                        <img src="{{ '../' . $book->image }}" alt="" class="w-full" />
                    </div>
                    <div class="max-h-full w-[70%] p-8 pt-10">
                        <div class="overflow-auto">
                            <h1 class="font-bold text-3xl">{{ $book->title }}</h1>
                            <h1 class="text-lg my-0 font-light italic mb-5">by: {{ $book->author }}</h1>
                            <h1 class="mb-5">{{ $book->synopsis }}</h1>    
                            <p>Type: {{ $book->type->type_name }}</p>
                            <p>Genre: {{ $book->genre->genre_name }}</p>

                        </div> 
                        
                        <x-primary-button class="mt-auto"
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal' , 'purchase')">
                            Buy
                        </x-primary-button>

                        <x-modal name="purchase" focusable>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3">
                                    Buy
                                </x-primary-button>
                            </div>
                        </x-modal>

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
                                <style>
                                    #rating::-webkit-outer-spin-button,
                                    #rating::-webkit-inner-spin-button {
                                    -webkit-appearance: none;
                                    margin: 0;
                                    }
                                </style>
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
                                            <style>
                                                #rating::-webkit-outer-spin-button,
                                                #rating::-webkit-inner-spin-button {
                                                -webkit-appearance: none;
                                                margin: 0;
                                                }
                                            </style>
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
                                <p>{{ $ur_review->review }}</p>
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
                                            {{ $review->review }}
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

    <!-- <script>
        document.getElementById('shopSelect').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            
            var price = selectedOption.getAttribute('data-price');
            
            document.getElementById('price').textContent = price ? 'Price: RM' + price : '';
        });
    </script> -->
    <script>
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