<?php

namespace App\Console\Commands;

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


        $this->CreateModule(['Clients','Solicituds']);
        $this->line('Creating modules');
        Artisan::call('migrate:fresh');
        Artisan::call('module:migrate-refresh Clients --seed');
        $this->line('Migracion');
        Artisan::call('db:seed', [
            '--class' => 'PizarronSeeder'
        ]);
         Artisan::call('db:seed', [
            '--class' => 'PizaronColumnSeeder'
        ]);
        Artisan::call('optimize:clear');


      //  $this->call('App\MyNameSpace\Page\Database\Migrations\SomeSeederClass');
     /*    $result = Process Process::run('php artisan migrate:fresh --seed --seeder=PizarronSeeder');

        return $result->output(); */

        return Command::SUCCESS;
    }
}
