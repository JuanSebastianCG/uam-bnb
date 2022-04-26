<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Requests\BillRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function create(Property $property)
    {
        return view('bills.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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

    }
}
