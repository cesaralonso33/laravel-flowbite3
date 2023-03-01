<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Column extends Model
{
    use HasFactory;


    public function Tabs()
    {
        return $this->hasOne(Edit_tab::class,'id','edit_tab_id');
    }


}
