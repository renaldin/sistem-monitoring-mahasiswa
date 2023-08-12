<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sp', function (Blueprint $table) {
            $table->unsignedInteger('id_kelas')->after('id');
            $table->string('deskripsi')->after('id_kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sp', function (Blueprint $table) {
            $table->dropColumn('id_kelas');
            $table->dropColumn('deskripsi');
        });
    }
}
