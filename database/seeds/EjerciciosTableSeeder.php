<?php

use Illuminate\Database\Seeder;

class EjerciciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ejercicios')->insert([
            'nombre' => str_random(10),
            'resumen' => str_random(10),
    
        ]);
    }
}
