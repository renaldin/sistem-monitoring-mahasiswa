<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKehadiransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kehadirans', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_jadwal')->nullable();
            $table->integer('id_mahasiswa')->nullable();
            $table->enum('status',['hadir','sakit','ijin','tanpa ketarangan']);
            $table->integer('pertemuan');
            $table->date('tanggal')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kehadirans');
    }
}
