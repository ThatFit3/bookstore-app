<?php

namespace App\Http\Controllers;

use App\Models\Shop;

use Illuminate\Http\Request;


class ShopController extends Controller
{
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
}
