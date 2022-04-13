<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photograph extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_image',
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
