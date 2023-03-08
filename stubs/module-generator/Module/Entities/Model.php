<?php

namespace Modules\{Module}\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\{Module}\Database\Factories\{Model}Factory;
use Modules\{Module}\Models\{Model}TemploraryFile;

class {Model} extends Model
{
    use HasFactory;

    protected $table = '{module_}';
    protected $guarded = [];


   public function tempfile():HasMany{
        return $this->hasMany({Model}TemploraryFile::class,'{module_}_id','id');
    }

    protected static function newFactory()
    {
        return {Model}Factory::new();
    }
}
