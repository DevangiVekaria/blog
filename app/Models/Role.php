<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name', 'description'
    ];

    public function permissions()
    {
        return $this->hasManyThrough(Permission::class, PermissionToRole::class, 'role_id', 'id', 'id', 'permission_id');
    }

    public function rolePermissions()
    {
        return $this->belongsToMany(PermissionToRole::class, 'permissions_to_roles', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
