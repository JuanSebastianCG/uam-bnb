<?php

namespace App\Http\Traits;

use App\Models\Qualification;

trait QueryTrait
{
    function counterQualification($properties_id ){

        $likes = Qualification::where('property_id', '=', $properties_id)->where('type', '=', 'like')->get();
        $dislikes = Qualification::where('property_id', '=', $properties_id)->where('type', '=', 'dislike')->get();
        $likes = $likes->count();
        $dislikes = $dislikes->count();

        return [
            'likes' => $likes,
            'dislikes' => $dislikes
          ];
    }



}

