<?php

namespace App\Traits;

use App\Models\module;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Illuminate\Support\Str;
use Symfony\Component\Process\ProcessUtils;

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

    public function CreateModule(array $NameModule)
        {
            foreach ($NameModule as $key => $value) {
                $path = "Modules/{$value}";
                if (\File::exists($path)) {
                    \File::deleteDirectory($path);
                    $this->line('eliminado');
                }
                // IMPORTANTE SE MODIFICA LA EXTENCION
                Artisan::call('module:build',['name' => $value ]);

                $files =  \File::files($path."/Database/Migrations");

                $listafiles=[];
                foreach ($files as $key) {
                    $file = pathinfo($key);
                    $listafiles[]=$file['basename'];
                }

                $this->filemigrate($path,$listafiles[2],"");
                $this->filemigrate($path,$listafiles[1],"");
                $this->filemigrate($path,$listafiles[0],"");
                $this->filemigrate($path,$listafiles[3],"");

                Artisan::call("module:enable {$value}");

                $minusc=strtolower($value);


                $underscore= $this->snake($value);
                DB::insert("insert into {$underscore}_edit_tab ( name,label) values (?, ?)", ['tab1', $value]);
                echo("insert tab");

            }

            module::where('rute', 'like','%app.%')
            ->update(['campolibre' => '1']);

            echo("update module");

            return "";
        }

        public function snake($value, $delimiter = '_')
        {
            if (! ctype_lower($value)) {
                $value = preg_replace('/\s+/u', '', ucwords($value));
                $value = mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $value));
            }
            return $value;
        }
        public function filemigrate($path,$FileName,$contiene){

                Artisan::call('migrate:refresh', [
                    '--path' => $path .'/Database/Migrations/'. $FileName
                ]);
                echo($FileName);


        }




    public function random_fruit()
        {
            static $i = 0;
            static $fruit = [
                'f1' => 'mango',
                'f2' => 'pear',
                'f3' => 'apple',
                'f4' => 'banana',
            ];
            // would be nice to write:
            //   static $keys = array_keys($fruit);
            // but PHP doesn't allow it so we have to assign the value
            // the first time we call the function
            static $keys;
            if ($i == 0) $keys = array_keys($fruit);
            $length = count($fruit);
            if ($i % $length == 0) shuffle($keys);
            return array($keys[$i % $length], $fruit[$keys[$i++ % $length]]);
        }




    }

