<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function characteristic_of_property()
    {
        return $this->hasMany(Characteristic_of_property::class);
    }

}
