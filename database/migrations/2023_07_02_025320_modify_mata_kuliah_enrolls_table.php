<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMataKuliahEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mata_kuliah_enrolls', function (Blueprint $table) {
            $table->renameColumn('id_kelas_enroll', 'id_kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mata_kuliah_enrolls', function (Blueprint $table) {
            $table->renameColumn('id_kelas', 'id_kelas_enroll');
        });
    }
}
