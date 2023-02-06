<?php

namespace App\Exports;

use App\Models\Column;
use App\Models\post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Concerns\WithHeadings;
class PostsExport implements FromCollection,WithHeadings
{
    public $posts;
    Public $titles=[];

    public function __construct($posts) {
        $this->posts = $posts;
    }

    public function headings(): array
    {
        return array_keys($this->collection()->first()->toArray());
    }

    public function collection()
    {

        $items=Column::where('user_id', Auth::id())->get();
        $cadena="id,";

        foreach($items as $item =>$value){
            $cadena=$cadena."{$value->name} as '{$value->label}',";
            $this->titles[]=$value->label;
        }


        //array_unshift($cola, "manzana", "frambuesa");
        //first
       /*  DB::enableQueryLog();
        $product =post::select(DB::raw(substr($cadena, 0,-1)))->whereIn('id', $this->posts)->get();
        $query2 = DB::getQueryLog();
        dd($query2); */

        if(empty($this->posts)){
            $product =post::select(DB::raw(substr($cadena, 0,-1)))->get();

        }else{
            $product =post::select(DB::raw(substr($cadena, 0,-1)))->whereIn('id', $this->posts)->get();

        }

        return $product;
        return post::select(DB::raw(substr($cadena, 0,-1)))->whereIn('id', $this->posts)->get();
    }


}
