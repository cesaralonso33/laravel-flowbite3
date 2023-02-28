<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edit_tab extends Model
{
    use HasFactory;

    protected $table = 'edit_tabs';

    public function scopeActive($query){
        return $query->where('state','Active');
        //->select('id','name','label')

    }
}
