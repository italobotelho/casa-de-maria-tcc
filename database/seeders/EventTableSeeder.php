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
                'title' => 'Maria Cristina da Rocha',
                'start' => '2024-10-11 13:30:00',
                'end' => '2024-10-12 14:00:00',
                'color' => '#c40233'
            ],
            [
                'title' => 'João Pedro de Sousa',
                'start' => '2024-10-02',
                'end' => '2024-10-03',
                'color' => '#29fdf2'
            ]
        ]);
    }
}
