<?php

namespace App\Console\Commands;

use App\Models\module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use App\Traits\ToolsCrad;

class Pizarron extends Command
{
    use ToolsCrad;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Pizarron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Data Pizarron';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $exitCode = Artisan::call('migrate:refresh', [
            '--path' => 'database/migrations',
        ]);


        $this->line('Migracion1');

        $this->CreateModule( ['Clients','Solicituds','Destinations','ClientsRates','Origins','TarifasAliados']);

        $this->line('Creating modules');

        Artisan::call('db:seed', [
            '--class' => 'PizarronSeeder'
        ]);
        $this->line('seed1');

        $salida= Artisan::call('db:seed', [
            '--class' => 'PizaronColumnSeeder'
        ]);
        $this->line($salida);
        $this->line('seed2');


        Artisan::call('optimize:clear');
        $this->line('optimize');

      //  $this->call('App\MyNameSpace\Page\Database\Migrations\SomeSeederClass');
     /*    $result = Process Process::run('php artisan migrate:fresh --seed --seeder=PizarronSeeder');

        return $result->output(); */

        module::where('id','>',4)->update([
            'campolibre'=>1
        ]);

        return Command::SUCCESS;
    }
}
