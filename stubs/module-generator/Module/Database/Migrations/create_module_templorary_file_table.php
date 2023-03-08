<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create{Module}TemploraryFileTable extends Migration
{
    public function up()
    {
        Schema::create('{module_}_templorary_file', function (Blueprint $table) {
            $table->id();
            $table->string('folder');
            $table->string('filename');
            $table->string('nameinput');

            $table->unsignedBigInteger('{module_}_id')->nullable();
            $table->foreign('{module_}_id')->references('id')->on('{module_}')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('{module_}_templorary_file');
    }
}
