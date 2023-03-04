<?php

namespace Database\Seeders;


use App\Models\Column;
use App\Models\Edit_tab;
use App\Models\post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Clients\Models\Client;
use Modules\Clients\Models\ClientColumn;
use Modules\Clients\Models\ClientEditTab;

class  PizaronColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function ListCuentas()
        {

        }

    public function TipoServicios()
        {

        }


    public function TipoUnidad()
        {

        }

    public function run()
    {

        $this->ListCuentas();
        $this->TipoServicios();
        $this->TipoUnidad();

        $editrow = new Edit_tab();
        $editrow->name = 'tab1';
        $editrow->label = 'SOLICITUDES';
        $editrow->save();

        $list = [
            'Semana',
            'Num',
            'Fecha Registro Solicitud',
            'Cliente',
            'Origen',
            'Destino',
            'Tipo de Unidad',
            'Tipo de Servicio',
            'Tipo de Carga',
            'Peso',
            'Cita de Carga',
            'Tarifa Cliente',
            'Vendedor',
            'Fecha_Hora Estatus',
            'Estatus',
            'Aliado',
            'Planeador',
            'Target',
            'Motivo'
        ];

        foreach ($list as $key => $value) {
            Column::create($this->newrow($value));
        }

        $ColumnClients=[
            'Clave',
            'Cuenta',
            'Cliente',
            'Estatus',
            'Razon Social',
            'PM_PF',
            'RFC de la empresa',
            'Direccion de la empresa_Fiscal',
            'CP',
            'Días de crédito',
            'Ejecutivo'
        ];


        foreach ($ColumnClients as $key => $value) {
            ClientColumn::create($this->newrow($value));
        }

        $editrow = new ClientEditTab();
        $editrow->name = 'tab1';
        $editrow->label = 'CLIENTES';
        $editrow->save();

        $rowe= new Client();
        $rowe->save();

    }

    public function newrow($nombre)
    {
        $row = [
            'label' => $nombre,
            'name' => str::replace(' ', '', $nombre),
            'required' => false,
            'list' =>  false,
            'hiddentable' =>  false,
            'edit_tab_id' => 1,
            'type' =>  fake()->randomElement(['TEXT']),
            'list_table'=>0,
            'user_id' => 1
        ];
        return $row;
    }


}
