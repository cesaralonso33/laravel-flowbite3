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
use Illuminate\Support\Facades\DB;

class ShowRole extends DataTableComponent
{
    protected $model = Role ::class;

/*
    public function builder(): Builder
    {


        $roles=Role::all();

        $collection = collect($roles);

        $consult= DB::SELECT("SELECT role_has_permissions.*,permissions.* FROM roles inner join role_has_permissions on role_has_permissions.role_id = roles.id inner join permissions on permissions.id=role_has_permissions.permission_id");

        $multiplied = $collection->map(function ($item, $key) {
            $ret= DB::SELECT("SELECT  permissions.id,permissions.name FROM roles inner join role_has_permissions on role_has_permissions.role_id = roles.id inner join permissions on permissions.id=role_has_permissions.permission_id where role_id=".$item->id);

            $ert=[

               "id_rol"=>$item->id,
               "nombre_rol"=>$item->name,
               "Permission"=>$ret
           ];
            return $ert;//$item->name;
        });

        return $multiplied->all();

        return User::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('users.name', 'like', '%' . $name . '%'))
            ->when($this->columnSearch['email'] ?? null, fn ($query, $email) => $query->where('users.email', 'like', '%' . $email . '%'));
    } */

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



