<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class OpcSelectInputCrad extends Component
{

    public string $name,$label,$required,$type;
    public bool $list;
    public array $values;




    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name,string $label,string $required,bool $list,string $values,string $type)
    {
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->list = $list;
        $this->values = json_decode($values,True);
        $this->type = $type;

    }

    function get_enum_values( $table, $field )
    {
        $type =  DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'");

        // return $type[0]->Type;
        //$type = DB::select("SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type[0]->Type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }

    public function customFunction(string $param): array
    {
        return $this->get_enum_values('posts', $param );

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
