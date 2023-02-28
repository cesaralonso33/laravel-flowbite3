<?php

namespace App\Traits;


use Illuminate\Support\Facades\DB;

trait ToolsCrad
{
    public function get_enum_values( $table, $field )
    {
        $type =  DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'");

        // return $type[0]->Type;
        //$type = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type[0]->Type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }
    public function get_enum_values_query( $table, $field )
    {
        $type =  DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'");

        preg_match("/^enum\(\'(.*)\'\)$/", $type[0]->Type, $matches);
        $enum = explode("','", $matches[1]);


        $collection = collect($enum)->map(function (string $name) {
            return [ 'label'=>strtoupper($name)];
        });

        return $collection;
    }

}

