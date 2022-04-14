<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Rental_availability;


class Rental_availabilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $p = new Rental_availability();
        $p->availability = true;
        $p->start_date = date("2022-02-17");
        $p->departure_date = date("2022-05-17");
        $p->property_id = "1";
        $p->save();

        $p = new Rental_availability();
        $p->availability = false;
        $p->start_date = date("2022-06-17");
        $p->departure_date = date("2022-010-17");
        $p->property_id = "1";
        $p->save();

        $p = new Rental_availability();
        $p->availability = true;
        $p->start_date = date("2022-02-17");
        $p->departure_date = date("2022-05-17");
        $p->property_id = "2";
        $p->save();


    }
}
