<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create{Module}EditTabTable extends Migration
{
    public function up()
    {
        Schema::create('{module_}_edit_tab', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->enum('state',['Active','Desactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('{module_}_edit_tab');
    }
}
