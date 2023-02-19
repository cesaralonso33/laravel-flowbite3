<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\module;
use Illuminate\Support\Facades\Cache;

class ShowModule extends DataTableComponent
{
    protected $model = module::class;


    public function bulkActions(): array
    {
        return [
            'activateSelected' => 'Activar',
            'desactivateSelected' => 'Desactivar',
        ];
    }

        public function desactivateSelected()
        {
            module::whereIn('id', $this->getSelected())->update(['status' => 'Desactive']);
            $this->updatecache();
            $this->clearSelected();
        }
        public function activateSelected()
        {
            module::whereIn('id', $this->getSelected())->update(['status' => "Active"]);
            $this->updatecache();
            $this->clearSelected();
        }


public function updatecache(){
    $collection = collect( module::select('name')->whereStatus('Active')->get()->toarray());
   Cache::put('CacheModule',$collection );
}

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
            ->sortable()
            ->setSortingPillTitle('Id')
            ->setSortingPillDirections('0-9', '9-0')
            ->html(),
                Column::make("Nombre", "name")
                ->sortable(),
                Column::make("Status", "status")
                ->sortable(),

        ];
    }
}
