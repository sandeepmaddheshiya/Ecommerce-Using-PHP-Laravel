<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model {
    use HasFactory;

    protected $fillable = ['name', 'description', 'slug'];

    public function product() {
        return $this->hasMany(product::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }

}

