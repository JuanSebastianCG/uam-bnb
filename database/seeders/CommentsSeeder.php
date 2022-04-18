<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = new Comment();
        $p->text = "Muy buen sitio para estar";
        $p->property_id = "1";
        $p->user_id = "2";
        $p->save();

        $p = new Comment();
        $p->text = "no me gusto  para nada";
        $p->property_id = "1";
        $p->user_id = "1";
        $p->save();

        $p = new Comment();
        $p->text = "esta muy bueno el lugar enserio";
        $p->property_id = "1";
        $p->user_id = "2";
        $p->save();
    }
}
