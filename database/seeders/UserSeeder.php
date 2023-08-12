<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin Polsub',
                'email' => 'adminpolsub@mail.com',
                'identity_number' => '001',
                'id_role' => 1,
                'password' => bcrypt('admin123'),
                'address' => 'Admin Address',
                'phone_number' => '012345678',
                'gender' => 'Laki-Laki',
                'id_prodi' => 1
            ],
            [
                'name' => 'Admin Jurusan',
                'email' => 'adminjurusan@mail.com',
                'identity_number' => '002',
                'id_role' => 2,
                'password' => bcrypt('admin123'),
                'address' => 'Admin Address',
                'phone_number' => '012345678',
                'gender' => 'Laki-Laki',
                'id_prodi' => 1
            ],
            [
                'name' => 'Dosen1',
                'email' => 'dosen@mail.com',
                'identity_number' => '101',
                'id_role' => 3,
                'password' => bcrypt('dosen1123'),
                'address' => 'Dosen1 Address',
                'phone_number' => '012345678',
                'gender' => 'Laki-Laki',
                'id_prodi' => 1
            ],
            [
                'name' => 'Dosen2',
                'email' => 'dosen2@mail.com',
                'identity_number' => '102',
                'id_role' => 3,
                'password' => bcrypt('dosen2123'),
                'address' => 'Dosen2 Address',
                'phone_number' => '012345678',
                'gender' => 'Laki-Laki',
                'id_prodi' => 2
            ],
        ];

        DB::table('users')->insert($users);
    }
}
