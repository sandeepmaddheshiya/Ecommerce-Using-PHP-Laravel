<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'salary', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Additional model methods and properties
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'admin_permissions');
    }
}
