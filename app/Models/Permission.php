<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Permission extends Model
{
    use HasFactory;

/*
    public function users() {
        return $this->hasManyThrough(
           User::class,    // The model to access to
            PermissionRole::class,    // The intermediate table that connects the User with the Role.
            'permission_id',   // The column of the intermediate table that connects to this model by its ID.
            'role_id',    // The column of the intermediate table that connects the Role by its ID.
            'id',    // The column that connects this model with the intermediate model table.
            'role_id'   // The column of the Users table that ties it to the Roles.
        );
    } */

    public function roles()
{
    return $this->belongsTo(Role::class,'');
}

}
