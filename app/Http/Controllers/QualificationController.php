<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{

    public function lookForQualification(Request $request )
    {


        $user = request()->user;
        $property = request()->property;
        $type = request()->type;
        $qualification = Qualification::where('user_id', '=', $user['id'])->where('property_id', '=', $property['id'])->get();
        

        return response()->json($data);
    }


    public function destroy(Rental_availability $rental_availability)
    {
        //
    }


}
