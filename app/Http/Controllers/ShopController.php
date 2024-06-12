<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Purchase;
use App\Models\ShopItem;
use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    function indexOrder(){
        if (request()->has('include')) {
            $include = request()->get('include');
        }else{
            $include = "pending";
        }
        
        $shop = Shop::where('user_id', Auth::user()->id)->first();
    
            // Check if the shop exists
            if (!$shop) {
                // Handle the case where the shop is not found
                abort(404, 'Shop not found');
            }

            // Retrieve the shop items for the shop
            $shopItems = ShopItem::where('shop_id', $shop->id)->pluck('id');
            
            // Retrieve the purchases for the shop items
            $shopOrders = Purchase::whereIn('shop_item_id', $shopItems)->get();

            return view('shop.order', compact('include', 'shopOrders'));
        }

    function create(Request $request){
        $shop = new Shop();

        $shop->shop_name = $request->shop_name;
        $shop->user_id = $request->user()->id;

        $shop->timestamps = false;

        $request->user()->is_shop_owner = 1;

        $request->user()->save();
        $shop->save();

        return redirect()->route('dashboard');
    }

    function shipOrder(Purchase $order){
        $order->pending = 1;

        $order->timestamps = false;
        $order->save();

        return redirect()->back();
    }

    function indexShop(){
        if (request()->has('include')) {
            $include = request()->get('include');
        }else{
            $include = "dashboard";
        }
        $shop = Shop::where('user_id', Auth::user()->id)->first();

        $shopItems = ShopItem::where('shop_id', $shop->id)->get();

        // Get the IDs of the books that are in the shop items
        $shopItemBookIds = $shopItems->pluck('book_id')->toArray();

        // Start with a query builder for books
        $booksQuery = Book::query();

        // Apply the search filter if present
        if (request()->has('search')) {
            $booksQuery->where('title', 'like', '%' . request()->get('search') . '%');
        }

        // Exclude the books that are already in the shop items
        if (!empty($shopItemBookIds)) {
            $booksQuery->whereNotIn('id', $shopItemBookIds);
        }

        // Retrieve the filtered books
        $books = $booksQuery->get();
        
        return view('shop.shop', compact('include', 'shop' , 'shopItems' , 'books'));
    }

    function out(ShopItem $item){
        $item->on_Stock = 0;

        $item->timestamps = false;
        $item->save();

        return redirect()->back();
    }

    function back(ShopItem $item){
        $item->on_Stock = 1;

        $item->timestamps = false;
        $item->save();

        return redirect()->back();
    }
    
    function edit(ShopItem $item , Request $request){
        $item->price = $request->price;

        $item->timestamps = false;
        $item->save();

        return redirect()->back();
    }

    function editShop(Shop $shop, Request $request){
        $shop->shop_name = $request->name;

        $shop->timestamps = false;
        $shop->save();

        return redirect()->back();
    }

    function createItem(Shop $shop, Request $request){
        $item = new ShopItem;

        $item->book_id = $request->book;
        $item->shop_id = $shop->id;
        $item->price = $request->price;
        
        $item->timestamps = false;
        $item->save();

        return redirect()->back();
    }
}
