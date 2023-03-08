<?php

namespace Modules\{Module}\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\{Module}\Database\Factories\{Model}ColumnFactory;



class {Model}Column extends Model
{
    use HasFactory;

    protected $table = '{module_}_columns';
    protected $guarded = [];


    public function Tabs()
    {
        return $this->hasOne({Model}EditTab::class,'id','edit_tab_id');
    }


    protected static function newFactory()
    {
        return {Model}ColumnFactory::new();
    }
}
