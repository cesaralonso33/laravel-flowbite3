<?php

namespace Modules\{Module}\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\{Module}\Database\Factories\{Model}TemploraryFileFactory;


class {Model}TemploraryFile extends Model
{
    use HasFactory;

    protected $table = '{module_}_templorary_file';
    protected $guarded = [];

    protected static function newFactory()
    {
        return {Model}TemploraryFileFactory::new();
    }
}
