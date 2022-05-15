<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\api\v1\PropertyResource;

use App\Models\Property;
use App\Models\User;
use App\Models\Characteristic_of_property;
use App\Models\Rental_availability;
use Carbon\Carbon;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {


        $properties = $this->filterProperty(
            $request->startDate,
            $request->endDate,
            $request->price,
            $request->city,
            $request->area

        );

        if ($properties == "1") {
            return response()->json(['error' => "el campo  'startDate' no puede ser mayor al campo 'endDate' " ], 406);

        }


        return response()->json(['data' => PropertyResource::collection($properties)], 200);
            //return response()->json(['data' => $property], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //return response()->json(['data' => $product], 200);

        return (new PropertyResource($property))
        ->response()
        ->setStatusCode(200);
    }




    public function filterProperty($startDate,$endDate,$price,$city,$area)
    {
        /* fechas disponibles de las propiedades filtradas */

            if ($startDate == null) { $startDate = date( '2000-01-1');}
            if ($endDate == null) { $endDate = date( '4000-01-1');}elseif (date($startDate)>date($endDate)) {
              return 1;
            }

            $rental_availabilities =
            Rental_availability::all()
            ->where("start_date",">=",$startDate)
            ->where("departure_date","<=",$endDate)
            ->where("availability","=",true);



            /* propiedades dentro de las fechas */
            $property = collect(new Property);
            foreach ($rental_availabilities as $rental_availability) {

                /* filtrar proprecio maximo */
                if ($price != null ) {
                    $startAvailability = Carbon::parse( $rental_availability->start_date);
                    $endAvailability = Carbon::parse( $rental_availability->departure_date);
                    $rentalValue = $endAvailability->diffInDays($startAvailability) * $rental_availability->property->daily_Lease_Value - 10;

                    $clean = 0;
                    if($rental_availability->property->area <= 100){
                        $clean = $rentalValue * 0.10;
                    }else{
                        $clean = $rentalValue * 0.15;
                    }
                    $service = $rentalValue * 0.23;
                    $total = $rentalValue + $clean + $service;

                    if ($price>=$rental_availability->property->daily_Lease_Value) {
                        $property->push($rental_availability->property)->unique('id');
                    }

                }else {
                    $property->push($rental_availability->property)->unique('id');
                }

            }
            $property=$property->unique();


        /* filtrar por ciudad */
        if ($area != null) {
            $property = $property->where('area','>=', $area);
        }


        /* filtrar por area */
        if ($city != null) {
            $property = $property->where('city',$city);
        }

        return $property;
    }


}
