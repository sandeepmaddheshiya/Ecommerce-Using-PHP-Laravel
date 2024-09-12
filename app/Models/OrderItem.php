<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'user_id', 'product_id', 'quantity', 'price'
    ];

    /**
     * Get the product associated with the order item.
     */
    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
