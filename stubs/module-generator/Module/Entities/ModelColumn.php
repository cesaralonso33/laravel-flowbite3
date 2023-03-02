<?php

namespace Modules\{Module}\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\{Module}\Database\Factories\{Model}ColumnFactory;

class {Model}Column extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected static function newFactory()
    {
        return {Model}ColumnFactory::new();
    }
}
