<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Characteristic;
use App\Models\Characteristic_of_property;
use App\Models\Comment;
use App\Models\Photograph;
use App\Models\User;
use App\Models\Rental_availability;


use App\Http\Traits\QueryTrait;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PropertyRequest;

class PropertyController extends Controller
{
    use QueryTrait;

    public function filterProperty(Request $request)
    {

        $startDate =date( $request->startDate[0]);
        $endDate= date($request->endDate[0]);
        $price= $request->price;
        $city= $request->city;
        $filter = collect(new Property );

        /* filtrar por acs y desc */
        $properties = Property::all();
        if ($price  !== 'default') {
            $properties = Property::orderBy('daily_Lease_Value', $price)->get();
            }

        /* filtrar por ciudad */
        if ($city != null) {
            $properties = $properties->where('city',$city);
        }

        /* fechas disponibles de las propiedades filtradas */
        $rental_availabilities = collect(new Rental_availability);
        foreach ($properties as $property) {
            if ($property->rental_availability) {
                $rental_availabilities->push($property->rental_availability) ;
            }
        }
        return response()->json($rental_availabilities);

        /* filtrar por fechas disponibles */
        if ($startDate !== null) {
            $rental_availabilities->where("start_date",">=",$startDate)->where("availability","=",true);
        }
        if ($endDate !== null) {
            $rental_availabilities->where("departure_date","<=",$endDate)->where("availability","=",true);
        }

        /* filtrar repetidos */
        foreach ($rental_availabilities as $rental_availability) {
        $repeated = false;
            foreach ($filter as $aux) {
                if ($aux->id == $rental_availability->property_id) {
                    $repeated = true;
                }
            }
            if (!$repeated) {
                $filter = $rental_availability->property;
            }
        }


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        $properties = $user->property()
        ->orderBy('created_at', 'desc')
        ->get();

        $photos = collect(new Photograph);
        for ($i=0; $i < count($properties); $i++) {
            $photos->push(Photograph::where("property_id","=",$properties[$i]->id)->orderBy('created_at', 'desc')->first());
        }

    return view('properties.index', compact('properties', 'user','photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $characteristics = Characteristic::all();
        return view('properties.create', compact('characteristics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $user = Auth::user();
        $property = new Property();

        $property->fill($request->input());
        $property->user_id = Auth::id();
        $property->save();

        /* agregar categoria */
        $categories = $request->input('checkbox');
        if ($request->has('checkbox')) {
            foreach ($categories as $categorie) {

                $characteristic = Characteristic::find($categorie);

                $characteristic_of_property = new Characteristic_of_property();
                $characteristic_of_property->property_id = $property->id;
                $characteristic_of_property->characteristic_id = (int)$characteristic->id;

                $characteristic_of_property->save();

            }
        }


        return redirect(route('properties.index', $user))->with('added', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property, User $user)
    {
        $user = Auth::user();
        $rental_availabilities = Rental_availability::where('property_id',"=",$property->id)->orderBy('created_at','DESC')->get();

        $qualifications = $this->counterQualification($property->id);
        $comments = $this->listOfComments($property->id);
        $photos = Photograph::where('property_id',$property->id)->orderBy('created_at','DESC')->get();


        $characteristic_of_property =  Characteristic_of_property::where('property_id',$property->id )->get();
        $characteristics = collect( new Characteristic);
        foreach ($characteristic_of_property as $characteristic_idFind) {
            $characteristics->add(Characteristic::find($characteristic_idFind->characteristic_id));
        }


        return view('properties.show', compact(
            'property',
            'user',
            'photos',
            'characteristics',
            'qualifications',
            'comments',
            'rental_availabilities'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        if($property->user_id==Auth::id()){
            return view('properties.edit', compact('property'));
        }else {
            return redirect(route('home'));
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
