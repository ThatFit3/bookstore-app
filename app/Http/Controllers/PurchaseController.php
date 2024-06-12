<?php

namespace App\Http\Controllers;
use App\Models\Purchase;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    function create(Request $request){
        $purchase = new Purchase();

        $purchase->user_id = $request->user()->id;

        $purchase->shop_item_id = $request->shop;
        $purchase->quantity = $request->quantity;

        $purchase->time_of_purchase = now();

        $purchase->timestamps = false;

        $purchase->save();

        return redirect()->back();
    }
}
