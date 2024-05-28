<?php

namespace App\Http\Controllers;
use App\Models\Type;
use App\Models\Genre;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    function index(){
        $types = Type::all();
        $genres = Genre::all();
        return view('admin', compact('types' , 'genres'));
    }

    function create(Request $request){
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->synopsis = $request->synopsis;
        $book->type_id = $request->type;
        $book->genre_id = $request->genre;
        
        $request->validate([
            'cover' => 'required|image|max:10240' //10MEGABYTES
        ]);
        
        $file = $request->file('cover');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file_path = $file->storeAs('public', $file_name);
        $book->image = 'storage/' . $file_name;

        $book->timestamps = false;

        $book->save();

        return redirect()->route('admin');
    }
}
