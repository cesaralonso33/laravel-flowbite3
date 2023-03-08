<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create{Module}ColumnTable extends Migration
{
    public function up()
    {
        Schema::create('{module_}_columns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->boolean('required')->default(false);
            $table->boolean('list')->default(false);
            $table->boolean('hiddentable')->default(false);
            $table->boolean('block')->default(false);
            $table->unsignedBigInteger('edit_tab_id');
            $table->string('type');
            $table->string('list_table')->default(false);
            $table->integer('user_id');
          //  $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();


            $table->foreign('edit_tab_id')->references('id')->on('{module_}_edit_tab');
        });
    }

    public function down()
    {
        Schema::dropIfExists('{model}_columns');
    }
}
