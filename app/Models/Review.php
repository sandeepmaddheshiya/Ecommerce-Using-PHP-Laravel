<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'reviews';

    // Specify the fillable attributes
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
    ];
    
    // Define relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
