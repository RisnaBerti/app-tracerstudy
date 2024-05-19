<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create data role
        $roles = [
            ['name' => 'bkk', 'guard_name' => 'web'],
            ['name' => 'waka-humas', 'guard_name' => 'web'],
            ['name' => 'pegawai', 'guard_name' => 'web'],
            ['name' => 'alumni', 'guard_name' => 'web'],
        ];
        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
