<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Characteristic_of_property;

class Characteristics_of_propertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $p = new Characteristic_of_property();
            $p->charactristic_id = "1";
            $p->property_id = "1";
            $p->save();

            $p = new Characteristic_of_property();
            $p->charactristic_id = "2";
            $p->property_id = "1";
            $p->save();

            $p = new Characteristic_of_property();
            $p->charactristic_id = "3";
            $p->property_id = "1";
            $p->save();

            $p = new Characteristic_of_property();
            $p->charactristic_id = "2";
            $p->property_id = "2";
            $p->save();


    }
}
