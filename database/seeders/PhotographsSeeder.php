<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use App\Models\Photograph;

class PhotographsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $p = new Photograph();
        $p->property_id = "1";
        $p->url_image = "1-image-165046960820.jpg";
        $p->save();

        $p = new Photograph();

        $p->property_id = "1";
        $p->save();

        $p = new Photograph();
        $p->property_id = "1";
        $p->save();

        $p = new Photograph();
        $p->property_id = "1";
        $p->save();

        $p = new Photograph();
        $p->property_id = "1";
        $p->save();

        $p = new Photograph();
        $p->property_id = "2";
        $p->save();


    }
}
