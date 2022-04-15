<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photograph extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $fillable = [
        'url_image',
        'property_id'
    ];


    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
