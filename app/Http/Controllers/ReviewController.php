<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    function post(Book $book, Request $request){
        $review = new Review();

        $review->book_id = $book->id;
        $review->user_id = $request->user()->id;

        $review->review = $request->review;
        $review->rating = $request->rating;

        $review->timestamps = false;
        
        $review->save();

        return redirect('books/' . $book->id);
    }

    function update(Request $request, Book $book){
        $review = Review::all()->find($request->review_id);

        $review->review = $request->review;
        $review->rating = $request->rating;

        $review->timestamps = false;

        $review->save();

        return redirect('books/' . $book->id);
    }

    function destroy(Request $request, Book $book){
        $review = Review::all()->find($request->review_id);        
        $review->delete();

        return redirect('books/' . $book->id);
    }
}
