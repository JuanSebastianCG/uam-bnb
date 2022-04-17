<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{

    public function lookForQualification(Request $request )
    {
        $qualification = Qualification::where('user_id', '=', request()->user['id'])->where('property_id', '=', request()->property['id'])->get();
        return response()->json($qualification);
    }

    public function allQualifications( $properties_id )
    {


        $likes = Qualification::where('property_id', '=', $properties_id)->where('type', '=', 'like')->get();
        $dislikes = Qualification::where('property_id', '=', $properties_id)->where('type', '=', 'dislike')->get();
        $likes = $likes->count();
        $dislikes = $dislikes->count();
        return response()->json(['likes' => $likes , 'dislikes' => $dislikes]);


    }

    public function store(Request $request)
    {

        $qualification = new Qualification();
        $qualification->user_id = request()->user['id'];
        $qualification->property_id = request()->property['id'];
        $qualification->type =request()->type ;
        $qualification->save();

        return response()->json(['success'=>'agregado con exito']);

    }

    public function update($qualification, Request $request)
    {

        $qualification = Qualification::find($qualification);
        $qualification->type = $request->type;

        $qualification->save();

        return response()->json(['success'=>'se edito con exito']);
    }

    public function destroy($id)
    {
        $qualification = Qualification::find($id)->delete();

        if ($qualification) {
            return response()->json(['success'=>'eliminado con exito']);
        }else {
            return response()->json(['success'=>'no se elimino nada']);
        }

    }


}
