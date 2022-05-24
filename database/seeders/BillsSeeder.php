<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Bill;

class BillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $p = new Bill();
        $p->rental_value = 100;
        $p->cleaning_cost = 200;
        $p->service_cost = 200.30;
        $p->paid_out = true;
        $p->property_id = "1";
        $p->user_id = "2";
        $p->rental_avalability = "1";
        $p->save();

        $p = new Bill();
        $p->rental_value = 1000;
        $p->cleaning_cost = 100;
        $p->service_cost = 200.30;
        $p->paid_out = true;
        $p->property_id = "1";
        $p->user_id = "3";
        $p->rental_avalability = "2";
        $p->save();

        $p = new Bill();
        $p->rental_value = 12000;
        $p->cleaning_cost = 300;
        $p->service_cost = 200.30;
        $p->paid_out = true;
        $p->property_id = "2";
        $p->user_id = "1";
        $p->rental_avalability = "3";
        $p->save();

    }
}
