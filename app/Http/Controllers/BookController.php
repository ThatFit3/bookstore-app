<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    function IndexDashboard(){
        $books = Book::with('type' , 'genre', 'shopItem')->get();
        return view('dashboard', compact('books'));
    }

    function indexDetail(Book $book){
        $book->load('type' , 'genre' , 'shop', 'shopItem' , 'review');
        $book->shopItem->load('shop');
        if (Auth::check()) {
            $ur_review = $book->review()->where('user_id', Auth::user()->id)->first();
        }
        
        $review_count = $book->loadCount('review')->review_count;

        if($ur_review){
            $review_count = $review_count - 1;
        }

        if (Auth::check()) {
            return view('details' , compact('book' , 'ur_review' , 'review_count'));
        }else{
            return view('details' , compact('book' , 'review_count'));
        }
        
    }
}
