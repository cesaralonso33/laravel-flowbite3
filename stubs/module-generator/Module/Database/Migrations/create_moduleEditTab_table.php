<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create{Module}ColumnTable extends Migration
{
    public function up()
    {
        Schema::create('{model_}_edit_tab', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->boolean('required')->default(false);
            $table->boolean('list')->default(false);
            $table->boolean('hiddentable')->default(false);
            $table->unsignedBigInteger('edit_tab_id');
            $table->string('type');
            $table->string('list_table')->default(false);
            $table->unsignedBigInteger("user_id");
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('edit_tab_id')->references('id')->on('edit_tabs');
        });
    }

    public function down()
    {
        Schema::dropIfExists('{module_}');
    }
}
