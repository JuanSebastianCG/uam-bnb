<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    $table->float('rental_value', 8, 2);
    $table->float('cleaning_cost', 8, 2);
    $table->float('service_cost', 8, 2);
    $table->boolean('paid_out');

    $table->foreignId('property_id')->references('id')->on('properties');
    $table->foreignId('user_id')->references('id')->on('users');
    $table->timestamps();

    protected $fillable = [
        'rental_value',
        'cleaning_cost',
        'service_cost',
        'paid_out',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }



}
