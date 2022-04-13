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
    public function characteristic()
    {
        return $this->hasMany(Characteristic::class);
    }
    public function photograph()
    {
        return $this->hasMany(Photograph::class);
    }

}
