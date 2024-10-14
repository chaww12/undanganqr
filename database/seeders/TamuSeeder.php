<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TamuSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('tamu')->insert([
                'idevent' => 7,
                'nama' => 'Tamu ' . $i,
                'jenistamu' => 'Jenis Tamu ' . $i,
                'instansi' => 'Instansi ' . $i,
                'alamat' => 'Alamat ' . $i,
            ]);
        }
    }
}
