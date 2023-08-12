<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProgramStudisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_studis', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_jurusan')->nullable();
            $table->string('nama_prodi')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('program_studis');
    }
}
