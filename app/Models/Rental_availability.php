<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental_availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'availability',
        'start_date',
        'departure_date',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function bill()
    {
        return $this->hasOne(Bill::class);
    }


}
