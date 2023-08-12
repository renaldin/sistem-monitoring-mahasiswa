<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role_name' => 'admin polsub'
            ],
            [
                'role_name' => 'admin jurusan'
            ],
            [
                'role_name' => 'dosen'
            ],
            [
                'role_name' => 'mahasiswa'
            ],
            [
                'role_name' => 'orang tua'
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
