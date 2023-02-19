<?php

//use Tests\TestCase;

namespace Tests\Unit;



use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/*
test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});
 */

class PostTest extends TestCase
{
       public function test_example()
    {
        $colump=[
          [
           "name"=>"uno",
            "label"=>"gastos mayores",
            "requi"=>true,
            "list"=>false,
            "list2"=>null
            ] ,
            [
                "name"=>"dos",
                 "label"=>"gastos menores",
                 "requi"=>false,
                 "list"=>false,
                 "list2"=>null
                 ] ,
                 [
                    "name"=>"dos",
                     "label"=>"gastos menores",
                     "requi"=>false,
                     "list"=>true,
                     "list2"=>"'hola','hola2','hola3'"
                     ] ,
        ];

       shell_exec(" php artisan migrate:refresh --seed");

        $credencial=[
            "email"=>"cad@crad.com",
            "password"=>"password"
        ];

        $user = User->factory();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/dashbord');

        $this->assertTrue(true);
    }
}
