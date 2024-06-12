<div class="w-full mt-6">
    <table class="table-auto w-full mt-6">
        <thead class="">
            <tr class="text-left rounded-md bg-gray-100 dark:bg-gray-900">
                <th class="p-2 border-collapse border border-slate-500">Id</th>
                <th class="p-2 border-collapse border border-slate-500" colspan="2">Book</th>
                <th class="p-2 border-collapse border border-slate-500">Price</th>
                <th class="p-2 border-collapse border border-slate-500">Quantity</th>
                <th class="p-2 border-collapse border border-slate-500">Total</th>
                <th class="p-2 border-collapse border border-slate-500">Bought by:</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shopOrders as $order)
            @if($order->pending == 1 && $order->arrive == 1)
            <tr class="text-left">
                <td class="border-collapse border border-slate-500 p-2 text-center">{{$order->id}}</td>
                <td class="border-collapse border border-slate-500 p-2 w-[10%] min-w-[100px]"><img src="{{ $order->shopItem->book->image }}" alt=""></td>
                <td class="border-collapse border border-slate-500 p-2">{{ html_entity_decode($order->shopItem->book->title) }} <br> {{ "by: " . $order->shopItem->book->author}}</td>
                <td class="border-collapse border border-slate-500 p-2">RM {{$order->shopItem->price}}</td>
                <td class="border-collapse border border-slate-500 p-2 text-center">{{$order->quantity}}</td>
                <td class="border-collapse border border-slate-500 p-2 text-center">RM {{ $order->shopItem->price * $order->quantity }}</td>
                <td class="border-collapse border border-slate-500 p-2 text-center">{{ $order->user->name }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>