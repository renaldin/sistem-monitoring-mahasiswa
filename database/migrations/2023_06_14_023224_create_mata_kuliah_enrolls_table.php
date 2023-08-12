<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMataKuliahEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mata_kuliah_enrolls', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_kelas_enroll')->nullable();
            $table->integer('id_mata_kuliah')->nullable();
            $table->integer('id_dosen')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mata_kuliah_enrolls');
    }
}
