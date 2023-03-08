<?php

namespace Modules\{Module}\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\{Module}\Database\Factories\{Model}EditTabFactory;

class {Model}EditTab extends Model
{
    use HasFactory;

    protected $table = '{module_}_edit_tab';

    protected $guarded = [];

    public function scopeActive($query){
        return $query->where('state','Active');
        //->select('id','name','label')

    }
    protected static function newFactory()
    {
        return {Model}EditTabFactory::new();
    }
}
