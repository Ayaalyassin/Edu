<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
<<<<<<< HEAD
=======
use Spatie\Permission\Models\Role;
>>>>>>> origin/khader

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin0@gmail.com',
            // 'role_id' => 3,
=======
        $admin=User::create([
            'name' => 'admin',
            'email' => 'admin0@gmail.com',
>>>>>>> origin/khader
            'password' => bcrypt('12341234'),
            'address' => 'malke',
            'governorate' => 'Damascus',
            'birth_date' => '1999-9-9',
<<<<<<< HEAD
            'image' => 'image.jpg',
            'google_id' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
=======
        ]);

        $role = Role::where('name','admin')->first();
        $admin->assignRole($role);
>>>>>>> origin/khader
    }
}
