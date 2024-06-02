<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    use HasFactory;

    public function book(){
        return $this->belongsTo(Book::class);   
    }

    public function shop(){
        return $this->belongsTo(Shop::class);   
    }
}
