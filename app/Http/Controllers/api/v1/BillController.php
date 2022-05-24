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
use App\Models\User;

use Validator;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('sanctum')->user();

        $bills = Bill::where('user_id', '=', $user->id)->get();

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
        $user = auth('sanctum')->user();
        $validation = $this->dateVerified($request->start_date, $request->departure_date, $request->property_id);

        if(is_numeric($validation) ){
            $validDate = $validation;
        }else{

            return response()->json(['message' => $validation], 400);
        }

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
            $bill->user_id = $user->id;
            $bill->rental_avalability = $validDate;
            $bill->save();

            return response()->json(['data' => new BillResource($bill)], 201);
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


        if($bill != null){
            $start_date = $request->start_date;
            $departure_date = $request->departure_date;
            $rental = Rental_availability::find($bill->rental_avalability);
            $user = auth('sanctum')->user();

       /*      $validation = $this->dateVerified($start_date, $departure_date, $bill->property_id);

            if(!is_numeric($validation) ){
                return response()->json(['message' => $validation], 400);
            } */


            if($bill->user_id == $user->id){
                if(now() < $start_date ){
                if ($start_date < now() ||  $start_date > $departure_date) {
                    return response()->json(['message' => 'Las fechas ingresadas son inválidas.'], 400);
                }else{
                    $verifyRentalStart = Rental_availability::where('id', '<>', $rental->id)->whereBetween('start_date', [$start_date, $departure_date])->get();
                    $verifyRentalEnd = Rental_availability::where('id', '<>', $rental->id)->whereBetween('departure_date', [$start_date, $departure_date])->get();
                        if ($verifyRentalStart->first() == null && $verifyRentalEnd->first() == null ) {
                            $rental->start_date = $start_date;
                            $rental->departure_date = $departure_date;
                            $rental->property_id = $bill->property_id;
                            $rental->save();
                            return response()->json(['data' => new BillResource($bill)], 201);
                        }else{
                            return response()->json(['message' => 'Las fechas ingresadas son inválidas.'], 400);
                        }
                    }
                }
            }else{
                return response()->json(['message' => 'Usted no posee permisos para modificar este recibo.'], 400);
            }
        }else{
            return response()->json(['message' => 'El recibo solicitado no existe.'], 400);
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
        $date = Rental_availability::where('id', '=', $bill->rental_avalability)->get();
        if(now() <= $date[0]->start_date){
            if($bill != null){
                $user = auth('sanctum')->user();
                if($bill->user_id == $user->id){
                    $availabilityDate = Rental_availability::find($bill->rental_avalability);
                    $bill->delete();
                    $availabilityDate->delete();
                    return response(null, 204);
                }else{
                    return response()->json(['message' => 'Usted no posee permisos para modificar este recibo.'], 400);
                }
            }else{
                return response()->json(['message' => 'El recibo solicitado no existe.'], 400);
            }
        }else{
            return response()->json(['message' => 'La fecha actual ya no está habilitada para cancelar el servicio.'], 400);
        }
    }

    /**
     * Verifica que la fecha ingresada sea correcta
     */
    public function dateVerified($start_date, $departure_date, $property_id){
        $fechas = DB::table('rental_availabilities')->where('property_id', '=', $property_id);

        $inputs = array(
            'start_date' => $start_date,
            'end_date'   => $departure_date
          );

        $rules = array(
            'start_date' => 'required|date',
            'end_date'   => 'required|date'
          );

        $validation = Validator::make($inputs, $rules);

        if( $validation->fails() )
        {
            return "los campos no son fechas y-m-d.";
        }


        if (  $start_date > $departure_date) {
            return "la fecha de incio debe ser mayo que la de finalización.";
        }else if($start_date < now()) {
            return "las fecha de inicio deben ser de hoy en adelante. ";
        }
        else{

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
                    return intval($rental->id);
                }else{
                    return "esa fecha no esta disponible.";
                }



        }
    }


}
