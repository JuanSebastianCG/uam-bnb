<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Property;


class PropertiesSeeder extends Seeder
{


    public function run()
    {

        $p = new Property();
        $p->name = "hogar dulce hogar";
        $p->description = "lugar para vacaciones";
        $p->area = 20;
        $p->capacity = 12;
        $p->daily_Lease_Value = 10;
        $p->type = "house";
        $p->latitude = "5.067";
        $p->longitude = "-75.517";
        $p->user_id= "1";
        $p->save();

        $p = new Property();
        $p->name = "hogar dulce hogar 2";
        $p->description = "lugar para pasarla bien";
        $p->area = 40;
        $p->capacity = 2;
        $p->daily_Lease_Value = 20;
        $p->type = "apartment";
        $p->latitude = "5.067";
        $p->longitude = "-75.517";
        $p->user_id= "1";
        $p->save();


        $p = new Property();
        $p->name = "hogar dulce hogar";
        $p->description = "lugar para vacaciones";
        $p->area = 20;
        $p->capacity = 12;
        $p->daily_Lease_Value = 10;
        $p->type = "house";
        $p->latitude = "5.067";
        $p->longitude = "-75.517";
        $p->user_id= "2";
        $p->save();
    }
}
