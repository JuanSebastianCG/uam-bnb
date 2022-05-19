<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'phone' => "3229498780",
            'age' => 18,
            'email' => "juan.cardenas@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:43"),
            'status' => "admin",
        ]);
        DB::table('users')->insert([
            'name' => "Don Asistente",
            'phone' => "3229498780",
            'age' => 19,
            'email' => "asistente@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:43"),
            'status' => "normal",
        ]);
        DB::table('users')->insert([
            'name' => "Diseñador",
            'phone' => "3229498780",
            'age' => 23,
            'email' => "diseño@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:43"),
            'status' => "normal",
        ]);
        DB::table('users')->insert([
            'name' => "manuel",
            'phone' => "3229498780",
            'age' => 42,
            'email' => "manuel@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:43"),
            'status' => "normal",
        ]);
        DB::table('users')->insert([
            'name' => "pepito",
            'phone' => "3229498780",
            'age' => 15,
            'email' => "pepito@autonoma.edu.co",
            'password' => Hash::make('hola1234'),
            'created_at' => date("2022-03-10 01:52:43"),
            'status' => "normal",
        ]);


    }
}
