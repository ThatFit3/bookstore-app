<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    function index(Book $book){
        $book->load('type' , 'genre' , 'shop', 'shopItem');
        $book->shopItem->load('shop');
        // dd($book);
        return view('details' , compact('book'));
    }
}
