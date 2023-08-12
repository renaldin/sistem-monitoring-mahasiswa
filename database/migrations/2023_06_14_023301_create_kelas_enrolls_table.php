<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKelasEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_enrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_mahasiswa')->nullable();
            $table->integer('id_kelas')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kelas_enrolls');
    }
}
