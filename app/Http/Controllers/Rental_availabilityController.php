<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Rental_availability;

class Rental_availabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
        return view('dates.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Property $property)
    {
        $user = Auth()->user();
        $fechas = DB::table('rental_availabilities')->where('property_id', '=', $request->property_id);

        if ($request->start_date < now() ) {

        }else{
            $rental = new Rental_availability();
            $rental->fill($request->input());
            $rental->property_id = $property->id;
            $rental->save();
            return redirect(route('properties.show',compact('property', 'user')));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental_availability  $rental_availability
     * @return \Illuminate\Http\Response
     */
    public function show(Rental_availability $rental_availability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rental_availability  $rental_availability
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental_availability $rental_availability)
    {
        //
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
