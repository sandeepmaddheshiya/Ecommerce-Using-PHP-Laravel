<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Specify which attributes are mass assignable
    protected $fillable = [
        'user_id',
        'total_amount',    // Updated to match the naming convention used in your controller
        'status',
        'payment_method', 
        'email',
        'phone', 
        'address', 
        'comment'  // Ensure this matches the column name in your database schema
    ];

    // Define the relationship with OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
