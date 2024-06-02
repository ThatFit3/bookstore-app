<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(Type::class);        
    }

    public function genre(){
        return $this->belongsTo(Genre::class);        
    }

    public function shopItem(){
        return $this->hasMany(ShopItem::class);
    }

    public function shop(){
        return $this->hasManyThrough(Shop::class, ShopItem::class, 'book_id', 'id', 'id', 'shop_id');
    }

    public function review(){
        return $this->hasMany(Review::class);
    }
}
