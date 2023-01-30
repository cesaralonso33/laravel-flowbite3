<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Livewire\Component;

class ShowRole extends DataTableComponent
{
    protected $model = Role ::class;

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
            Column::make("Modulo", "guard_name")
                ->sortable(),
        ];
    }

}



