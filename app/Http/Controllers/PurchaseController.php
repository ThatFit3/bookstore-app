<?php

namespace App\Http\Controllers;
use App\Models\Purchase;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PurchaseController extends Controller
{
    function index(){
        if (request()->has('include')) {
            $include = request()->get('include');
        }else{
            $include = "pending";
        }
        
        $purchases = Purchase::where('user_id' , Auth::user()->id)->get();
        $purchases->load('shopItem' , 'user');

        return view('purchase.purchase' , compact('include' , 'purchases'));
    }

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

    function purchaseArrive(Purchase $purchase){
        $purchase->arrive = 1;

        $purchase->timestamps = false;

        $purchase->save();
        return redirect()->back();
    }
}

