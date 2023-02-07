<?php

namespace App\Http\Livewire;

use App\Models\module;
use App\Models\Permission;
use App\Models\Role;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Component;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class ShowPermission extends DataTableComponent
{

   //protected $model =  DB::raw("SELECT DISTINCT t.* FROM `modules` p join permissions t ON t.name LIKE CONCAT('%', p.name ,'%')  WHERE p.status='Active';");


 public function builder(): Builder
    {
        //return  DB::raw("SELECT DISTINCT t.* FROM `modules` p join permissions t ON t.name LIKE CONCAT('%', p.name ,'%')  WHERE p.status='Active';");;
       return permission::query()
       ->join('modules', function ($join) {
            $join->on('permissions.name', 'like', DB::raw("CONCAT('%', modules.name ,'%') ") );
        })->where('status','Active');

       // return DB::select("SELECT DISTINCT t.* FROM `modules` p  join permissions t ON t.name LIKE CONCAT('%', p.name ,'%') WHERE p.status='Active' ");

    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }


    public function columns(): array
    {

        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Name", "name")
                ->sortable()->searchable(),
                Column::make("Modulo", "guard_name")
                ->sortable(),
        ];
    }
}
