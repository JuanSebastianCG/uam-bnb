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


    public function index()
    {
        return $this->allProperties(0);
    }

    public function indexUser($user){
        return $this->allProperties($user);
    }

    public function allProperties($user){

        if ($user == NULL) {
            $properties = Property::orderBy('created_at', 'desc')
            ->get();
        }else{
            $user = Auth::user();
            $properties = $user->property()
            ->orderBy('created_at', 'desc')
            ->get();
        }


        $qualifications = collect();
        foreach ($properties as $property) {
            $qualifications->push($this->counterQualification($property->id));
        }

        $photos = collect(new Photograph);
        for ($i=0; $i < count($properties); $i++) {
            $photos->push(Photograph::where("property_id","=",$properties[$i]->id)->orderBy('created_at', 'desc')->first());
        }

        return view('properties.index', compact('properties', 'user','photos','qualifications'));
    }





    public function filterProperty(Request $request)
    {
        $startDate =date( $request->startDate[0]);
        $endDate= date($request->endDate[0]);
        if ($startDate == null) { $startDate = date( '2000-01-1');}
        if ($endDate == null) { $endDate = date( '4000-01-1');}

        $price= $request->price;
        $city= $request->city;

        /* fechas disponibles de las propiedades filtradas */
        $rental_availabilities =
        Rental_availability::all()
        ->where("start_date",">",$startDate)
        ->where("departure_date","<",$endDate)
        ->where("availability","=",true);

        /* propiedades dentro de las fechas */
        $property = collect(new Property);
        foreach ($rental_availabilities as $rental_availability) {
            $property->push($rental_availability->property)->unique('id');;
        }
        $property=$property->unique();


        /* filtrar por acs y desc */

        if ($price == "asc") {
            $property = $property->sortBy('daily_Lease_Value');
        }
        if ($price == "desc") {
            $property = $property->sortByDesc('daily_Lease_Value');
        }
        return response()->json($property);


        /* filtrar por ciudad */
        if ($city != null) {
            $property = $property->where('city',$city);
        }

        return response()->json($property);
    }

    public function create()
    {

        $characteristics = Characteristic::all();
        return view('properties.create', compact('characteristics'));
    }


    public function store(PropertyRequest $request)
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


    public function edit(Property $property)
    {

        if($property->user_id==Auth::id()){
            $user = Auth::user();
            $rental_availabilities = Rental_availability::where('property_id',"=",$property->id)->orderBy('created_at','DESC')->get();

            $qualifications = $this->counterQualification($property->id);
            $comments = $this->listOfComments($property->id);
            $photos = Photograph::where('property_id',$property->id)->orderBy('created_at','DESC')->get();

            return view('properties.edit', compact(
                'property',
                'user',
                'photos',
                'qualifications',
                'comments',
                'rental_availabilities'));
        }else {
            return redirect(route('home'));
        }
    }


    public function update(Request $request, Property $property)
    {
        $user = Auth::user();
        $property->fill($request->input());
        $property->user_id = Auth::id();
        $property->save();

        $comprobado = true;
        return redirect('/properties');
    }


    public function destroy(Property $property)
    {
        $user = Auth()->user();
        if($property->user_id == $user->id){
            $property->delete();
            return redirect('/properties');
        }else{
            return view('welcome');
        }
    }
}
