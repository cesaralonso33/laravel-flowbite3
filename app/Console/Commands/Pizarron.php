<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Pizarron extends Command
{
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
        Artisan::call('migrate:fresh');
        //$this->call(ColumnSeeder::class);
        Artisan::call('db:seed', [
            '--class' => 'PizarronSeeder'
        ]);

         Artisan::call('db:seed', [
            '--class' => 'PizaronColumnSeeder'
        ]);
      //  $this->call('App\MyNameSpace\Page\Database\Migrations\SomeSeederClass');
     /*    $result = Process Process::run('php artisan migrate:fresh --seed --seeder=PizarronSeeder');

        return $result->output(); */

        return Command::SUCCESS;
    }
}
