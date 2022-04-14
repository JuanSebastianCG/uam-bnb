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

    public function characteristics_of_propertys()
    {
        return $this->hasMany(Characteristics_of_propertys::class);
    }

}
