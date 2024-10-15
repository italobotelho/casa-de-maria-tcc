<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'title' => 'Reunião',
                'start' => '2024-10-11 21:30:00',
                'end' => '2024-10-12 21:30:00',
                'color' => '#c40233',
                'description' => 'Reunião com cliente'
            ],
            [
                'title' => 'Ligar p/ cliente',
                'start' => '2024-10-02',
                'end' => '2024-10-02',
                'color' => '#29fdf2',
                'description' => 'Falar com cliente'
            ]
        ]);
    }
}
