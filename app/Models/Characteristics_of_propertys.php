<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristics_of_propertys extends Model
{
    use HasFactory;

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }

}
