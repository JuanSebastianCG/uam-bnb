<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Characteristic;

class CharacteristicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = new Characteristic();
        $p->name = "Cocina";
        $p->save();

        $p = new Characteristic();
        $p->name = "Sala";
        $p->save();

        $p = new Characteristic();
        $p->name = "Comedor";
        $p->save();

        $p = new Characteristic();
        $p->name = "Patio";
        $p->save();
    }
}
