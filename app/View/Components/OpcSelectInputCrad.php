<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ToolsController;
use App\Traits\ToolsCrad;
use Illuminate\View\Component;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class OpcSelectInputCrad extends Component
{

    use ToolsCrad;

    public string $name,$label,$required,$type,$listable;
    public bool $list;
    public array $values;


   /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name,string $label,string $required,bool $list,string $values,string $type,string $listable)
    {
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->list = $list;
        $this->values = json_decode($values,True);
        $this->type = $type;
        $this->listable = $listable;
    }


    public function customFunction(string $param): array
    {
        return $this->get_enum_values('posts', $param );

    }

    public function list_table($valortable){
        return $valortable;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.opc-select-input-crad');
    }
}
