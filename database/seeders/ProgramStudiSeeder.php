<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodi = [
            [
                'id_jurusan' => 1,
                'nama_prodi' => 'Teknik & Ilmu Komputer'
            ],
            [
                'id_jurusan' => 2,
                'nama_prodi' => 'Teknik & Ilmu Komputer'
            ],
        ];

    DB::table('program_studis')->insert($prodi);
    }
}
