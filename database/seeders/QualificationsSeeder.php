<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Qualification;

class QualificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = new Qualification();
        $p->type = "like";
        $p->property_id = "1";
        $p->user_id = "1";
        $p->save();

        $p = new Qualification();
        $p->type = "like";
        $p->property_id = "1";
        $p->user_id = "2";
        $p->save();

        $p = new Qualification();
        $p->type = "dislike";
        $p->property_id = "2";
        $p->user_id = "1";
        $p->save();
    }
}
