<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'student',
<<<<<<< HEAD
            'guard_name'=>'api'
=======
>>>>>>> origin/khader

        ]);
        Role::create([
            'name' => 'teacher',
<<<<<<< HEAD
            'guard_name'=>'api'
=======
>>>>>>> origin/khader

        ]);
        Role::create([
            'name' => 'admin',
<<<<<<< HEAD
            'guard_name'=>'api'
        ]);

        Role::create([
            'name' => 'employee',
            'guard_name'=>'api'
=======

>>>>>>> origin/khader
        ]);
    }
}
