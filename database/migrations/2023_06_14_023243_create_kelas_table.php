<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_tahun_ajaran')->nullable();
            $table->string('nama_kelas')->nullable();
            $table->string('kode_kelas')->nullable();
            $table->integer('id_dosen_wali')->nullable();
            $table->integer('id_prodi')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kelas');
    }
}
