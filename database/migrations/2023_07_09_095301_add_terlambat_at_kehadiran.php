<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTerlambatAtKehadiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kehadirans', function (Blueprint $table) {
            $table->integer('terlambat')->default(0)->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kehadirans', function (Blueprint $table) {
            $table->dropColumn('terlambat');
        });
    }
}
