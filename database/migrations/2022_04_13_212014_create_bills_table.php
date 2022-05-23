<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();

            $table->float('rental_value', 8, 2);
            $table->float('cleaning_cost', 8, 2);
            $table->float('service_cost', 8, 2);
            $table->boolean('paid_out');

            $table->foreignId('property_id')->references('id')->on('properties')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('rental_avalability')->nullable()->default(null)->references('id')->on('rental_availabilities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('bills');
    }
}