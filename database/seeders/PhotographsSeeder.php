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
        $p->url_image = "1-image-165047258477.jpg";
        $p->save();

        $p = new Photograph();
        $p->property_id = "1";
        $p->url_image = "1-image-1650472720685.jpg";
        $p->save();

        $p = new Photograph();
        $p->property_id = "2";
        $p->url_image = "6137721001651010347.jpg";
        $p->save();


        $p = new Photograph();
        $p->property_id = "2";
        $p->url_image = "12898568421651010540.jpg";
        $p->save();

        $p = new Photograph();
        $p->property_id = "3";
        $p->url_image = "5420682491651010870.jpg";
        $p->save();

        $p = new Photograph();
        $p->property_id = "3";
        $p->url_image = "6315144191651010890.png";
        $p->save();

        $p = new Photograph();
        $p->property_id = "3";
        $p->url_image = "11328753871651010834.jpg";
        $p->save();
    }
}
