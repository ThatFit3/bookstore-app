<div class="w-full mt-6">
    <form action="/shop/{{ $shop->id }}" class="w-full flex items-center" method="POST">
        @csrf
        @method("PUT")
        <x-text-input name="name" type="text" class="w-full me-2" value="{{ $shop->shop_name }}" />
        <x-primary-button>Save</x-primary-button>
    </form>
    <table class="table-auto w-full mt-6">
        <thead class="">
            <tr class="text-left rounded-md bg-gray-100 dark:bg-gray-900">
                <th class="p-2 border-collapse border border-slate-500">Id</th>
                <th class="p-2 border-collapse border border-slate-500" colspan="2">Book</th>
                <th class="p-2 border-collapse border border-slate-500">Genre and type</th>
                <th class="p-2 border-collapse border border-slate-500">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shopItems as $item)
            <tr class="text-left">
                <td class="border-collapse border border-slate-500 p-2 text-center">{{$item->id}}</td>
                <td class="border-collapse border border-slate-500 p-2 w-[10%] min-w-[100px]"><img src="{{ $item->book->image }}" alt=""></td>
                <td class="border-collapse border border-slate-500 p-2">{{ html_entity_decode($item->book->title) }} <br> {{ "by: " . $item->book->author}}</td>
                <td class="border-collapse border border-slate-500 p-2 text-left">{{ $item->book->type->type_name }} , {{ $item->book->genre->genre_name }}</td>
                <td class="border-collapse border border-slate-500 p-2">RM {{$item->price}}</td>
            </tr>
            <tr class="text-left">
                <td class="border-collapse border border-slate-500 p-2 text-right" colspan="5">
                    <div class="flex flex-row-reverse gap-3">
                        <x-primary-button
                        x-data="" x-on:click.prevent="$dispatch('open-modal' , 'edit-{{ $item->id }}')">Edit price</x-primary-button>
                        @if($item->on_Stock == 1)
                        <form action="shop/{{ $item->id }}/oof" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-secondary-button type="submit">Out of stock</x-secondary-button>
                        </form>
                        @else
                        <form action="shop/{{ $item->id }}/oof" method="POST">
                            @csrf
                            @method('PATCH')
                            <x-secondary-button type="submit">Back in stock</x-secondary-button>
                        </form>
                        @endif
                    </div>

                    <x-modal name="edit-{{ $item->id }}" focusable>
                        <div class="text-left p-6">
                            <form action="shop/{{ $item->id }}/edit" method="POST">
                                @csrf
                                @method('PUT')
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input name="price" type="boolean" class="p-2" value="{{ $item->price }}" />
                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancel') }}
                                    </x-secondary-button>

                                    <x-primary-button class="ms-3">
                                        Save
                                    </x-primary-button>
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