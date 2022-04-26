<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\BillRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Rental_availability;
use Carbon\Carbon;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $properties = Property::All();
        $bills = $user->bill()
        ->orderBy('created_at', 'desc')
        ->get();

        return view('bills.index', compact('user', 'bills', 'properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property, Rental_availability $availability)
    {
        $start = Carbon::parse($availability->start_date);
        $end = Carbon::parse($availability->departure_date);
        $price = $end->diffInDays($start) * $property->daily_Lease_Value - 10;

        $clean = 0;

        if($property->area <= 100){
            $clean = $price * 0.10;
        }else{
            $clean = $price * 0.15;
        }

        $service = $price * 0.23;

        $total = $price + $clean + $service;
        return view('bills.create', compact('property', 'price', 'clean', 'service', 'total', 'availability'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Property $property, Rental_availability $availability)
    {
        $user = Auth::user();
        $start = Carbon::parse($availability->start_date);
        $end = Carbon::parse($availability->departure_date);
        $price = $end->diffInDays($start) * $property->daily_Lease_Value - 10;

        $clean = 0;

        if($property->area <= 100){
            $clean = $price * 0.10;
        }else{
            $clean = $price * 0.15;
        }

        $service = $price * 0.23;

        $total = $price + $clean + $service;

        $bill = new Bill();
        $bill->rental_value = $price;
        $bill->cleaning_cost = $clean;
        $bill->service_cost = $service;
        $bill->paid_out = false;
        $bill->property_id = $property->id;
        $bill->user_id = $user->id;

        $bill->save();

        $rental_availability = Rental_availability::where('id', '=', $availability->id)
                             ->update(['availability' => false]);

        return redirect('/bills');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bill)
    {
        $request->paid_out = true;
        $bill_pago = Bill::find($bill);
        $bill_pago->paid_out = $request->paid_out;
        $bill_pago->save();

        return redirect('/bills');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill, Request $request)
    {
        //
    }

    public function pagar(BillRequest $request, Bill $bill){
        //
    }
}
