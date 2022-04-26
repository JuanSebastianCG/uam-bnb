<?php

namespace App\Http\Controllers;

use App\Models\Rental_availability;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
    public function create()
    {
        return view('dates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->start_date<= now()) {
            return back()->with('message', ['msg', __('Fecha invalida')]);
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
