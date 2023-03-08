<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PizarronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ModuleSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ListTableSeeder::class);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'crad@crad.com',
            'isAdmin'=>'Admin'
            ])->assignRole('Super-Admin');

            $roles=['Logística',
            'Monitoreo',
            'Jefe Logística',
            'Mantenimiento',
            'Aux. Facturación',
            'Ventas',
            'Jefe Ventas',
            'Compras',
            'Cobranza',
            'Jefe Admin.',
            'Princing',
            'Jefe Princing'];

foreach ($roles as $key => $value) {
    Role::create(['name' => $value]);
    # code...
}

    }
}
