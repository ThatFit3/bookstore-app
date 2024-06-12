<div class="w-full mt-6">
    <table class="table-auto w-full mt-6">
        <thead class="">
            <tr class="text-left rounded-md bg-gray-100 dark:bg-gray-900">
                <th class="p-2 border-collapse border border-slate-500">Id</th>
                <th class="p-2 border-collapse border border-slate-500" colspan="2">Book</th>
                <th class="p-2 border-collapse border border-slate-500">Price</th>
                <th class="p-2 border-collapse border border-slate-500">Quantity</th>
                <th class="p-2 border-collapse border border-slate-500">Total</th>
                <th class="p-2 border-collapse border border-slate-500">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
            @if($purchase->pending == 1 && $purchase->arrive == 0)
            <tr class="text-left">
                <td class="border-collapse border border-slate-500 p-2 text-center">{{$purchase->id}}</td>
                <td class="border-collapse border border-slate-500 p-2 w-[10%] min-w-[100px]"><img src="{{ $purchase->shopItem->book->image }}" alt=""></td>
                <td class="border-collapse border border-slate-500 p-2">{{ html_entity_decode($purchase->shopItem->book->title) }} <br> {{ "by: " . $purchase->shopItem->book->author}}</td>
                <td class="border-collapse border border-slate-500 p-2">RM {{$purchase->shopItem->price}}</td>
                <td class="border-collapse border border-slate-500 p-2 text-center">{{$purchase->quantity}}</td>
                <td class="border-collapse border border-slate-500 p-2 text-center">RM {{ $purchase->shopItem->price * $purchase->quantity }}</td>
                <td class="border-collapse border border-slate-500 p-2 text-center">
                    <form action="purchase/{{ $purchase->id }}/arrive" method="POST">
                        @csrf
                        @method('PUT')
                        <x-primary-button>Received</x-primary-button>
                    </form>
                </td>
                
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>