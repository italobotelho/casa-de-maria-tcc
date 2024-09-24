<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('convenio')->insert([
            ['nome_conv' => 'Unimed'],
            ['nome_conv' => 'Sulamérica'],
            ['nome_conv' => 'Amil'],
            ['nome_conv' => 'Particular'],
            ['nome_conv' => 'Samaritano'],
        ]);

    }
}

