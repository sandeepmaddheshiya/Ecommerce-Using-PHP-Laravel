<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_permissions');
    }
}
