<?php

namespace Database\Seeders;


use App\Models\Column;
use App\Models\Edit_tab;
use App\Models\post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Clients\Models\Client;
use Modules\Clients\Models\ClientColumn;
use Modules\Clients\Models\ClientEditTab;
use Modules\Solicituds\Models\SolicitudColumn;
use Modules\Destinations\Models\DestinationColumn;

use Modules\ClientsRates\Models\ClientsRateColumn;
use Modules\Origins\Models\OriginColumn;
use Modules\TarifasAliados\Models\TarifasAliadoColumn;

class  PizaronColumnSeeder extends Seeder
{

    public function run()
    {
        $this->setColumnClients();

        $this->setColumnSolicituds();

        $this->SetColumnDestinations();

        $this->setColumnClientsRates();

        $this->SetColumnOrigins();

        $this->SetColumnTarifasAliados();
    }

    public function setColumnClientsRates()
    {
        $listC = [
            'Clave',
            'Cliente',
            'Origen',
            'Destino',
            'Tipo de Unidad',
            'Precio Subtotal'

        ];

        foreach ($listC as $key => $value) {
            ClientsRateColumn::create($this->newrow($value));
        }
    }

    public function setColumnClients()
    {


        $ColumnClients = [
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
    }

    public function setColumnSolicituds()
    {
        $ColumnSolici = [
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



        foreach ($ColumnSolici as $key => $value) {
            SolicitudColumn::create($this->newrow($value));
        }
    }


    public function SetColumnDestinations()
    {
        $listcolum = [
            'Clave',
            'Cliente',
            'Origen',
            'Destino',
            'Tipo de Unidad',
            'Precio Subtotal'
        ];


        foreach ($listcolum as $key => $value) {
            DestinationColumn::create($this->newrow($value));
        }
    }



    public function SetColumnOrigins()
    {
        $listcolum = [
            'Clave',
            'Nombre la empresa',
            'Razon Social',
            'RFC de la empresa',
            'Dirección de la empresa',
            'CP'
        ];


        foreach ($listcolum as $key => $value) {
            OriginColumn::create($this->newrow($value));
        }
    }

    public function SetColumnTarifasAliados()
    {
        $listcolum = [
            'Origen ',
            'Destino',
            'Tipo de Unidad',
            'Aliado',
            'Codigo Ruta_id del proveedor',
            'Tarifa'
        ];


        foreach ($listcolum as $key => $value) {
            TarifasAliadoColumn::create($this->newrow($value));
        }
    }


    public function newrow($nombre)
    {
        $row = [
            'name' => str::replace(' ', '', $nombre),
            'label' => $nombre,
            'required' => false,
            'list' =>  false,
            'hiddentable' =>  false,
            'block' => 0,
            'edit_tab_id' => 1,
            'type' =>  fake()->randomElement(['TEXT']),
            'list_table' => 0,
            'user_id' => 1
        ];
        return $row;
    }
}
