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
    public function index(){
        $types = Type::all();
        $genres = Genre::all();
        $booksQuery = Book::with('type', 'genre', 'shopItem'); // Start with a query builder

        if (request()->has('search')) {
            $booksQuery = $booksQuery->where('title', 'like', '%' . request()->get('search') . '%');
        }

        $books = $booksQuery->get(); // Execute the query and get the results


        return view('admin.admin', compact('types', 'genres', 'books'));

    }

    function create(Request $request){
        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->synopsis = $request->synopsis;
        $book->type_id = $request->type;
        $book->genre_id = $request->genre;
        
        if ($request->hasFile('cover')) {
            $request->validate([
                'cover' => 'required|image|max:10240' // 10MB
            ]);
    
            $file = $request->file('cover');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file_path = $file->storeAs('public', $file_name);
            $book->image = 'storage/' . $file_name;
        } else {
            $book->image = null;
        }
        
        $book->timestamps = false;
        
        $book->save();

        return redirect()->route('admin');
    }

    function update(Request $request, Book $book){
        $book->title = $request->title;
        $book->author = $request->author;
        $book->synopsis = $request->synopsis;
        $book->type_id = $request->type;
        $book->genre_id = $request->genre;

        if ($request->hasFile('cover')) {
            $imagePath = $book->image; // Replace 'image_path' with the actual column name

            // Adjust the path by removing the 'storage/' prefix to point to the correct location
            if (str_starts_with($imagePath, 'storage/')) {
                $imagePath = str_replace('storage/', '', $imagePath);
            }
        
            // Check if the image exists and delete it
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $request->validate([
                'cover' => 'required|image|max:10240' // 10MB
            ]);
    
            $file = $request->file('cover');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file_path = $file->storeAs('public', $file_name);
            $book->image = 'storage/' . $file_name;
        }

        $book->timestamps = false;

        $book->save();

        return redirect()->back();
    }

    function destroy(Book $book){
        $imagePath = $book->image; // Replace 'image_path' with the actual column name

        // Adjust the path by removing the 'storage/' prefix to point to the correct location
        if (str_starts_with($imagePath, 'storage/')) {
            $imagePath = str_replace('storage/', '', $imagePath);
        }
    
        // Check if the image exists and delete it
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        $book->delete();

        return redirect()->route('admin');
    }
}
