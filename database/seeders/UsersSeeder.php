<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Juan Cardenas",
            'email' => "juan.cardenas@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:43"),
        ]);
        DB::table('users')->insert([
            'name' => "Don Asistente",
            'email' => "asistente@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:43"),
        ]);
        DB::table('users')->insert([
            'name' => "Diseñador",
            'email' => "diseño@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:48"),
        ]);

        DB::table('users')->insert([
            'name' => "manuel",
            'email' => "manuel@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:41"),
        ]);
        DB::table('users')->insert([
            'name' => "pepito",
            'email' => "pepito@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:47"),
        ]);
    }
}
