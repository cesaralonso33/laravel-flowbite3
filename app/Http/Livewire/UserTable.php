<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Illuminate\Support\Str;

class UserTable extends DataTableComponent
{

    public function builder(): Builder
    {

        return User::where('id','>',1);

    }


    public function bulkActions(): array
    {
        return [
            'NewUser' => __('New User'),
            'export' => 'Exportar',
            'activateSelected' => 'Activar',
            'desactivateSelected' => 'Desactivar',
        ];
    }
//=======================================================================================================
//
//  #####  ##    ##  #####    #####   #####    ######    ###    #####
//  ##      ##  ##   ##  ##  ##   ##  ##  ##     ##     ## ##   ##  ##
//  #####    ####    #####   ##   ##  #####      ##    ##   ##  #####
//  ##      ##  ##   ##      ##   ##  ##  ##     ##    #######  ##  ##
//  #####  ##    ##  ##       #####   ##   ##    ##    ##   ##  ##   ##
//
//=======================================================================================================

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new UsersExport($users), 'users.xlsx');
    }



    public function NewUser(){
        return redirect('/users/create');
    }

   //==========================================================================================================================================================================================================================
//
//    ###     ####  ######  ##  ##   ##    ###    ######  #####          ###    ##     ##  ####          ####    #####   ####    ###     ####  ######  ##  ##   ##    ###    ######  #####
//   ## ##   ##       ##    ##  ##   ##   ## ##     ##    ##            ## ##   ####   ##  ##  ##        ##  ##  ##     ##      ## ##   ##       ##    ##  ##   ##   ## ##     ##    ##
//  ##   ##  ##       ##    ##  ##   ##  ##   ##    ##    #####        ##   ##  ##  ## ##  ##  ##        ##  ##  #####   ###   ##   ##  ##       ##    ##  ##   ##  ##   ##    ##    #####
//  #######  ##       ##    ##   ## ##   #######    ##    ##           #######  ##    ###  ##  ##        ##  ##  ##        ##  #######  ##       ##    ##   ## ##   #######    ##    ##
//  ##   ##   ####    ##    ##    ###    ##   ##    ##    #####        ##   ##  ##     ##  ####          ####    #####  ####   ##   ##   ####    ##    ##    ###    ##   ##    ##    #####
//
//==========================================================================================================================================================================================================================


    public function desactivateSelected()
    {
        User::whereIn('id', $this->getSelected())->update(['active' => false]);

      /*   foreach($this->getSelected() as $item)
        {
            // These are strings since they came from an HTML element
            dump($item);
        }
 */
        $this->clearSelected();
    }
    public function activateSelected()
    {

        User::whereIn('id', $this->getSelected())->update(['active' => true]);

        /*
        foreach($this->getSelected() as $item)
        {
            // These are strings since they came from an HTML element
            dump($item);
        } */

        $this->clearSelected();
    }




//==========================================================================================
//
//   ####   #####   ##      ##   ##  ###    ###  ##     ##
//  ##     ##   ##  ##      ##   ##  ## #  # ##  ####   ##
//  ##     ##   ##  ##      ##   ##  ##  ##  ##  ##  ## ##
//  ##     ##   ##  ##      ##   ##  ##      ##  ##    ###
//   ####   #####   ######   #####   ##      ##  ##     ##
//
//==========================================================================================



    public function configure(): void
    {
        $this->setPrimaryKey('id');

    }
    public $columnSearch = [
        'name' => null,
        'email' => null,
    ];


    public function columns(): array
    {
        return [
            /* ImageColumn::make('Avatar')
            ->location(function($row) {
                return asset('img/logo-'.$row->id.'.png');
            })
            ->attributes(function($row) {
                return [
                    'class' => 'w-8 h-8 rounded-full',
                ];
            }),*/
            Column::make('ID', 'id')
            ->sortable()
            ->setSortingPillTitle('Id')
            ->setSortingPillDirections('0-9', '9-0')
            ->html(),
                BooleanColumn::make('active')
                ->sortable()
                ->collapseOnMobile(),

            Column::make("Name", "name")
                ->sortable()->searchable(),

            Column::make("Email", "email")
                ->sortable()
                ->collapseOnMobile()
                ->searchable(),


           /*  ComponentColumn::make("Email", "role")
                ->component('email')
                ->attributes(fn ($value, $row, Column $column) => [
                    'type' => Str::endsWith($value, 'example.org') ? 'success' : 'danger',
                    'dismissible' => true,
                ]),
 */

 Column::make('role')
    ->format(function($value, $row, Column $column){
            return $row->roles[0]->name;
        }),


              /*   Column::make("Rol", "namerole")
                ->sortable()
                ->collapseOnMobile()
                ->searchable(),
 */

                /* ->secondaryHeader(function() {
                    return "ww";//view('tables.cells.input-search', ['field' => 'email', 'columnSearch' => $this->columnSearch]);
                }), */

            Column::make("Created at", "created_at")
                ->sortable()->collapseOnMobile(),

          ButtonGroupColumn::make('Actions')
            ->attributes(function($row) {
                return [
                    'class' => 'space-x-2',
                ];
            })
            ->buttons([


                LinkColumn::make('Edit')
                    ->title(fn($row) => __('Edit') )
                    ->location(fn($row) => route('users.edit', $row))
                    ->attributes(function($row) {
                        return [
                            'class' => 'underline text-blue-500 hover:no-underline',
                        ];
                    }),
            ]),

           /*  Column::make("Updated at", "updated_at")
                ->sortable(), */
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Active')
            ->setFilterPillTitle('User Status')
            ->setFilterPillValues([
                '1' => 'Active',
                '0' => 'Inactive',
            ])
            ->options([
                '' => 'All',
                '1' => 'Yes',
                '0' => 'No',
            ])
            ->filter(function(Builder $builder, string $value) {
                if ($value === '1') {
                    $builder->where('active', true);
                } elseif ($value === '0') {
                    $builder->where('active', false);
                }
            }),
        ];
    }



}

