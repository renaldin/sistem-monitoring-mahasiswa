<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMataKuliahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nama_mata_kuliah')->nullable();
            $table->integer('id_prodi')->nullable();
            $table->string('kode_mata_kuliah')->nullable();
            $table->integer('sks')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mata_kuliahs');
    }
}
