<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Column as modelcolum;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;


use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

use Illuminate\Database\Eloquent\Builder;

class ConfcTable extends DataTableComponent
{

    public function builder(): Builder
    {
      //  dd(modelcolum::query()->with('Tabs')->get());
        return modelcolum::query()->with('Tabs');
    }


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

/*
    public function bulkActions(): array
    {
        return [
            'exportSelected' => 'Export',
        ];
    }


    public function exportSelected()
{
    foreach($this->getSelected() as $item)
    {
        // These are strings since they came from an HTML element
    }
    $this->clearSelected();
}
 */


    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->setSortingPillTitle('Key')
                ->setSortingPillDirections('0-9', '9-0')
                ->html(),

            Column::make("Nombre", "label")
                ->sortable()
                ->searchable(),

                BooleanColumn::make('Requiere','required')
                ->sortable(),


                BooleanColumn::make('Lista','list')
                ->sortable(),


                BooleanColumn::make('Oculto','hiddentable')
                ->sortable(),

                Column::make("Grupo", "Tabs.label")
                ->sortable()
                ->searchable(),


                Column::make("Tipo", "type")
                ->sortable()
                ->searchable(),


                Column::make("Tabla relacionada", "list_table")
                ->sortable()
                ->searchable(),

                ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([

                    LinkColumn::make('Edit')
                        ->title(fn($row) => __('Edit') )
                        ->location(fn($row) => route('configc.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),
                ]),


        ];
    }
}
