<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'area',
        'capacity',
        'city',
        'daily_Lease_Value',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function bill()
    {
        return $this->hasMany(Bill::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function qualification()
    {
        return $this->hasMany(Qualification::class);
    }
    public function characteristic_of_property()
    {
        return $this->hasMany(Characteristic_of_property::class);
    }
    public function photograph()
    {
        return $this->hasMany(Photograph::class);
    }
    public function rental_availability()
    {
        return $this->hasMany(Rental_availability::class);
    }

}
