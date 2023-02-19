<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
/* use Spatie\Permission\Contracts\Role as ContractsRole;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


/*
    protected $appends=['namerole' ];
    public function getNameroleAttribute()
	{
        try {

            $roles = $this->getRoleNames(); // Returns a collection

             if(empty($roles )){
                 return "";
             }else{
                 return $roles[0] ;
             }

         } catch (\Throwable $th) {
             return $th->getMessage();
         }
	} */

}
