<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic_of_property extends Model
{
    use HasFactory;
    public $table = "characteristics_of_properties";
    protected $fillable = [
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function characteristic()
    {
        return $this->belongsTo(Characteristic::class);
    }


}
