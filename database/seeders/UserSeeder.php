<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 
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

        DB::table('users')->insert([
            'username' => 'superadmin',
            'password' => Hash::make('superadmin123'), 
            'role' => 'superadmin',
        ]);

        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'), 
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'username' => 'registrasi',
            'password' => Hash::make('registrasi123'), 
            'role' => 'registrasi',
        ]);
    }
}
