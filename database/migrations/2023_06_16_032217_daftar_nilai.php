<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DaftarNilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_nilais', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_tugas');
            $table->string('id_tahun_ajaran');
            $table->integer('id_kelas')->nullable();
            $table->integer('id_mata_kuliah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('daftar_nilais');
    }
    }

