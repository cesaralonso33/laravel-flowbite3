<?php

namespace App\Observers;

use App\Models\Column;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class ColumnObserver
{
    /**
     * Handle the Column "created" event.
     *
     * @param  \App\Models\Column  $column
     * @return void
     */
    public function created(Column $column)
    {


        $ctype     = ($column->type == "IMAGE" ? 'TEXT' : $column->type);

        if ($ctype === "LIST" and !empty($column->list)) {
            DB::SELECT("ALTER TABLE posts ADD {$column->name} enum({$column->list}) {$column->opcval}");
        } else {
            DB::SELECT("ALTER TABLE posts ADD {$column->name} {$ctype} NULL;");
        }

        Permission::create(['name' => 'Post.create.' . $column->name]);
        Permission::create(['name' => 'Post.view.' . $column->name]);
        Permission::create(['name' => 'Post.edit.' . $column->name]);
        Permission::create(['name' => 'Post.delete.' . $column->name]);

    }

    /**
     * Handle the Column "updated" event.
     *
     * @param  \App\Models\Column  $column
     * @return void
     */
    public function updated(Column $column)
    {
        //
    }

    /**
     * Handle the Column "deleted" event.
     *
     * @param  \App\Models\Column  $column
     * @return void
     */
    public function deleted(Column $column)
    {
        //
    }

    /**
     * Handle the Column "restored" event.
     *
     * @param  \App\Models\Column  $column
     * @return void
     */
    public function restored(Column $column)
    {
        //
    }

    /**
     * Handle the Column "force deleted" event.
     *
     * @param  \App\Models\Column  $column
     * @return void
     */
    public function forceDeleted(Column $column)
    {
        //
    }
}
