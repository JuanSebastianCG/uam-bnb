<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Property;


class PropertiesSeeder extends Seeder
{
    $table->string('name');
    $table->string('description');
    $table->smallInteger('area');
    $table->tinyInteger('capacity');
    $table->float('daily_Lease_Value');
    $table->enum('type', ['house', 'apartment']);

    $table->float('latitude');
    $table->float('longitude');

    $table->foreignId('user_id')->references('id')->on('users');
    $table->timestamps();

    public function run()
    {
        $p = new Property();
        $p->name = "hogar grande";
        $p->description = "comida";
        $p->area = "comida";
        $p->capacity = "comida";
        $p->daily_Lease_Value = "comida";
        $p->type = "comida";
        $p->latitude = "5.067";
        $p->longitude = "-75.517";
        $p->user_id= "longitude";
        $p->save();

        $p = new Property();
        $p->categoryName = "hogar";
        $p->save();

        $p = new Property();
        $p->categoryName = "hogar";
        $p->save();
    }
}
