<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;

class SuperAdmin extends User
{
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password',
    ];
}
