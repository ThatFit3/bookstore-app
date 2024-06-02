<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;

    function book(){
        return $this->belongsTo(Book::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
