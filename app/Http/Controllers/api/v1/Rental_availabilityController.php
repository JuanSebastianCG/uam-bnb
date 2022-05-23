<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Rental_availability;
use Illuminate\Http\Request;
use App\Models\Property;

class Rental_availabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentals = Rental_availability::all();

        return response()->json(['data' => $rentals], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental_availability  $rental_availability
     * @return \Illuminate\Http\Response
     */
    public function show(Rental_availability $rental)
    {
        return response()->json(['data' => $rental], 201);
    }

    public function showOfProperty(Property $property)
    {
        $rentals = Rental_availability::where('property_id', $property->id)->get();

        return response()->json(['data' => $rentals], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rental_availability  $rental_availability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental_availability $rental_availability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rental_availability  $rental_availability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental_availability $rental_availability)
    {
        //
    }
}
