<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Component;

use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShowRole extends DataTableComponent
{
   // protected $model = Role ::class;


    public function builder(): Builder
    {

        if(Auth::user()->getRoleNames()[0]==="Super-Admin"   ){
            return Role::query()->orderby('id','asc');
        }else{
            return Role::query()->where('name','<>','Super-Admin')->orderby('id','asc');
        }

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
                ->sortable(),
           /*  Column::make("Modulo", "guard_name")
                ->sortable(), */
            ButtonGroupColumn::make('Actions')
            ->attributes(function($row) {
                return [
                    'class' => 'space-x-2',
                ];
            })
            ->buttons([

                LinkColumn::make('Edit')
                    ->title(fn($row) => __('Edit') )
                    ->location(fn($row) => route('roles.edit', $row))
                    ->attributes(function($row) {
                        return [
                            'class' => 'underline text-blue-500 hover:no-underline',
                        ];
                    }),
            ]),

        ];
    }

}



