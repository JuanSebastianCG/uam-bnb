<?php

namespace App\Http\Traits;

use App\Models\Qualification;
use App\Models\Comment;
use App\Models\User;

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

    function listOfComments($properties_id){

        $comments = Comment::where('property_id','=',$properties_id)->orderBy('created_at','DESC')->paginate(10);
        $userComments = collect(new User);
        $commentsDiffForHuman = collect();

        for ($i=0; $i < count($comments); $i++) {
            $userComments->push(User::find($comments[$i]->user_id));
            $commentsDiffForHuman->push($comments[$i]->created_at->diffForHumans());
        }
        return [
            'comments' => $comments,
            'userComments' => $userComments,
            'commentsDiffForHuman' => $commentsDiffForHuman
          ];
    }


}

