<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event')->insert([
            [
                'poster' => null, 
                'namaevent' => 'Konser Musik',
                'waktu' => '2024-12-01 19:00:00',
            ],
            [
                'poster' => null, 
                'namaevent' => 'Seminar Teknologi',
                'waktu' => '2024-11-15 09:00:00',
            ],
            [
                'poster' => null, 
                'namaevent' => 'Pameran Seni',
                'waktu' => '2024-10-20 18:00:00',
            ],
            [
                'poster' => null, 
                'namaevent' => 'Workshop Kreatif',
                'waktu' => '2024-11-25 13:00:00',
            ],
        ]);
    }
}
