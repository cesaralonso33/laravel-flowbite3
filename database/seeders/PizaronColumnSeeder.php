<?php

namespace Database\Seeders;


use App\Models\Column;
use App\Models\Edit_tab;
use App\Models\post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class  PizaronColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


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

        for ($i = 0; $i < 600; $i++) {
            $itt = new post();
            $itt->save();
        }
    }

    public function newrow($nombre)
    {
        $row = [
            'label' => $nombre,
            'name' => str::replace(' ', '', $nombre),
            'required' => false,
            'list' =>  false,
            'hiddentable' =>  false,
            'edit_tab_id' => Edit_tab::all()->random()->id,
            'type' =>  fake()->randomElement(['TEXT']),
            'list_table'=>0,
            'user_id' => 1
        ];
        return $row;
    }
}
