<?php

namespace App\Models;

use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'description', 'price', 'address'];

    // Product.php
public function category()
    {
    return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($product) {
    //         $product->slug = Str::slug($product->title);
    //     });

    //     static::updating(function ($product) {
    //         $product->slug = Str::slug($product->title);
    //     });
    // }


}
