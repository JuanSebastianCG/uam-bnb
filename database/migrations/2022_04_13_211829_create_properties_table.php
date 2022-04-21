<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->longText('description');
            $table->smallInteger('area');
            $table->tinyInteger('capacity');
            $table->float('daily_Lease_Value');
            $table->enum('type', ['house', 'apartment']);

            $table->float('latitude');
            $table->float('longitude');

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
