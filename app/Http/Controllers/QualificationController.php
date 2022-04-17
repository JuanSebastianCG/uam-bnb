<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{

    public function lookForQualification(Request $request )
    {
        $qualification = Qualification::where('user_id', '=', request()->user['id'])->where('property_id', '=', request()->property['id'])->get('id');
        return response()->json($qualification);
    }

    public function store(Request $request)
    {


        $user = Auth::user();
        $property = new Property();

        $property->fill($request->input());
        $property->user_id = Auth::id();
        $property->save();

        /* agregar categoria */
        $categories = $request->input('checkbox');
        if ($request->has('checkbox')) {
            foreach ($categories as $categorie) {

                $characteristic = Characteristic::find($categorie);

                $characteristic_of_property = new Characteristic_of_property();
                $characteristic_of_property->property_id = $property->id;
                $characteristic_of_property->characteristic_id = (int)$characteristic->id;

                $characteristic_of_property->save();

            }
        }


        return redirect(route('properties.index', $user))->with('added', 'ok');
    }
    

    public function destroy( $id )
    {
        $qualification = Qualification::find($id)->delete();

        if ($qualification) {
            return response()->json(['success'=>'eliminado con exito']);
        }else {
            return response()->json(['success'=>'no se elimino nada']);
        }

    }


}
