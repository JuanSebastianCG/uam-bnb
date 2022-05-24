<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use App\Models\Rental_availability;
use Carbon\Carbon;
use App\Http\Resources\api\v1\BillResource;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::All();

        return response()->json($bills->rental_availability);
        return response()->json(['data' => BillResource::collection($bills)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validDate = $this->dateVerified($request->start_date, $request->departure_date, $request->property_id);
        $property = Property::find($request->property_id);
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->departure_date);

        if($validDate !== -1){
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
            $bill->user_id = $request->user_id;
            $bill->rental_avalability = $validDate;
            $bill->save();

            return response()->json(['data' => BillResource::collection($bill)], 201);
        }else{
            return response()->json(['message' => 'Las fechas ingresadas son inválidas.'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        return response()->json(['data' => $bill], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $start_date = $request->start_date;
        $departure_date = $request->departure_date;
        $rental = Rental_availability::find($bill->rental_avalability);

        if(now() < $start_date ){
            if ($start_date < now() ||  $start_date > $departure_date) {
                return response()->json(['message' => 'Las fechas ingresadas son inválidas.'], 400);
            }else{
                $verifyRentalStart = Rental_availability::where('id', '<>', $rental->id)->whereBetween('start_date', [$start_date, $departure_date])->get();
                $verifyRentalEnd = Rental_availability::where('id', '<>', $rental->id)->whereBetween('departure_date', [$start_date, $departure_date])->get();
                if ($verifyRentalStart->first() == null && $verifyRentalEnd->first() == null ) {
                    $rental->start_date = $start_date;
                    $rental->departure_date = $departure_date;
                    $rental->save();
                    return response()->json(['data' => $bill], 201);
                }else{
                    return response()->json(['message' => 'Las fechas ingresadas son inválidas.'], 400);
                }

            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        $availabilityDate = Rental_availability::find($bill->rental_avalability);
        $bill->delete();
        $availabilityDate->delete();
        return response(null, 204);
    }

    /**
     * Verifica que la fecha ingresada sea correcta
     */
    public function dateVerified($start_date, $departure_date, $property_id){
        $fechas = DB::table('rental_availabilities')->where('property_id', '=', $property_id);

        if ($start_date < now() ||  $start_date > $departure_date) {
            return -1;
        }else{
            $verifyRentalStart = Rental_availability::whereBetween('start_date', [$start_date, $departure_date])->get();
            $verifyRentalEnd = Rental_availability::whereBetween('departure_date', [$start_date, $departure_date])->get();
            if ($verifyRentalStart->first() == null && $verifyRentalEnd->first() == null ) {
                $rental = new Rental_availability();
                $rental->start_date = $start_date;
                $rental->departure_date = $departure_date;
                $rental->property_id = $property_id;
                $rental->availability = false;
                /* Rental_availability::create($rental); */
                $rental->save();
                return $rental->id;
            }else{
                return -1;
            }

        }
    }


}
