<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionToRole extends Model
{
    protected $table = 'permissions_to_roles';
    protected $fillable = [
        'permission_id', 'role_id'
    ];
    public $timestamps = false;
}
