<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusans = [
            [
                'nama_jurusan' => 'Teknik Informatika',
            ],
            [
                'nama_jurusan' => 'Sistem Informasi',
            ],
        ];

        DB::table('jurusans')->insert($jurusans);
    }
}
