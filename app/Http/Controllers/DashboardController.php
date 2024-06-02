<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    function Index(){
        $books = Book::with('type' , 'genre', 'shopItem')->get();
        return view('dashboard', compact('books'));
    }
}
