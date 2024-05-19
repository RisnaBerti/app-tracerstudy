<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'id_role' => 1,
                'is_aktif' => 1,
            ],
            // [
            //     'username' => 'waka',
            //     'password' => bcrypt('waka'),
            //     'id_role' => 2,
            //     'is_aktif' => 1,
            // ],
            // [
            //     'username' => 'pegawai',
            //     'password' => bcrypt('pegawai'),
            //     'id_role' => 3,
            //     'is_aktif' => 1,
            // ],
            // [
            //     'username' => 'alumni',
            //     'password' => bcrypt('alumni'),
            //     'id_role' => 4,
            //     'is_aktif' => 1,
            // ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
