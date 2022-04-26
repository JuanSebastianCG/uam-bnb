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
        $start_date = $request['start_date'];
        $departure_date = $request['departure_date'];

        if ($request->start_date < now() ||  $start_date > $departure_date) {

            return redirect(route('properties.show',compact('property', 'user')))->with('error', 'ok');;
        }else{

            $verifyRentalStart = Rental_availability::whereBetween('start_date', [$start_date, $departure_date])->get();
            $verifyRentalEnd = Rental_availability::whereBetween('departure_date', [$start_date, $departure_date])->get();

            if ($verifyRentalStart->first() == null && $verifyRentalEnd->first() == null ) {

                $rental = new Rental_availability();
                $rental->fill($request->input());
                $rental->property_id = $property->id;
                $rental->save();
                return redirect(route('properties.show',compact('property', 'user')))->with('added', 'ok');
            }else {
                return redirect(route('properties.show',compact('property', 'user')))->with('error', 'ok');;

            }

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
