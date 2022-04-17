<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

use App\Http\Traits\QueryTrait;

class QualificationController extends Controller
{

    use QueryTrait;

    public function lookForQualification(Request $request )
    {

        $qualification = Qualification::where('user_id', '=', request()->user['id'])->where('property_id', '=', request()->property['id'])->get();
        return response()->json($qualification);
    }

    public function allQualifications( $properties_id )
    {
        return response()->json( $this->counterQualification($properties_id ));
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
