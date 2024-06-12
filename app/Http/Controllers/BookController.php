<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Type;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    function IndexDashboard(){
        $books = Book::with('type', 'genre', 'shopItem');

        if (request()->has('search')) {
            $books = $books->where('title', 'like', '%' . request()->get('search') . '%');
        }

        $books = $books->get();
        return view('dashboard', compact('books'));
    }

    function indexDetail(Book $book){
        $types = Type::all();
        $genres = Genre::all();
        $book->load('type' , 'genre' , 'shop', 'shopItem' , 'review');
        $book->shopItem->load('shop');
        if (Auth::check()) {
            $ur_review = $book->review()->where('user_id', Auth::user()->id)->first();
        }
        
        $review_count = $book->loadCount('review')->review_count;

        if($ur_review){
            $review_count = $review_count - 1;
        }

        $book->synopsis = html_entity_decode($book->synopsis);
        $book->title = html_entity_decode($book->title);

        if (Auth::check()) {
            return view('details' , compact('book' , 'ur_review' , 'review_count', 'types' , 'genres'));
        }else{
            return view('details' , compact('book' , 'review_count'));
        }
        
    }
}
