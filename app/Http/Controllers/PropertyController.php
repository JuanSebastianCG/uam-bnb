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


    public function index(Request $request)
    {
        return $this->allProperties($request, null);
    }
    public function indexUser($user, Request $request)
    {

        return $this->allProperties($request, $user);
    }

    public function allProperties($request, $user){

        $startDate =date($request->get('startDate'));
        $endDate= date($request->get('endDate'));
        $city= $request->get('city');

        $price= $request->get('price');

        $old = [
            'starDate' => $startDate,
            'endDate' => $endDate,
            'city' => $city,
            'price' => $price
          ];


        if ($user == NULL) {
            $properties = $this->filterProperty($startDate,$endDate,$price,$city,null);
        }else{
            $user = Auth::user();
            $properties =  $this->filterProperty($startDate,$endDate,$price,$city,$user);
        }

        $qualifications = $this->qualifications($properties);
        $photos = $this->firstPhotos($properties);


        return view('properties.index', compact('properties', 'user','photos','qualifications', 'old'));
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

            $characteristics = Characteristic::all();
            $characteristic_of_property =  Characteristic_of_property::where('property_id',$property->id )->get();
            return view('properties.edit', compact(
                'property',
                'user',
                'photos',
                'qualifications',
                'comments',
                'rental_availabilities',
                'characteristics', 'characteristic_of_property'));
        }else {
            return redirect(route('home'));
        }
    }


    public function update(PropertyRequest $request, Property $property)
    {
        $user = Auth::user();
        $property->fill($request->input());
        $property->user_id = Auth::id();

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


    /*================================================================000  */

    public function qualifications($properties){

        $qualifications = collect();

        if ($properties->first() != null) {
            foreach ($properties as $property) {
                $qualifications->push($this->counterQualification($property->id));
            }
        }

        return $qualifications;
    }

    public function firstPhotos($properties){

        $photos = collect(new Photograph);

        if ($properties->first() != null) {
            foreach ($properties as $property) {
                $photos->push(Photograph::where("property_id","=",$property->id)->orderBy('created_at', 'desc')->first());
            }
        }
        return $photos;
    }

    public function filterProperty($startDate,$endDate,$price,$city,$user)
    {
        /* fechas disponibles de las propiedades filtradas */
        if ($startDate != null || $endDate != null) {
            if ($startDate == null) { $startDate = date( '2000-01-1');}
            if ($endDate == null) { $endDate = date( '4000-01-1');}
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
        }else {
            $property = Property::all();
        }


        /* filtrar por ciudad */
        if ($city != null) {
            $property = $property->where('city',$city);
        }


        /* filtrar si es para ver las propiedades de un usuario */
        if ($user != null) {
            $property = $property->where('user_id',$user['id']);
        }

        /* filtrar por acs y desc */

        if ($price == "asc") {
            $property = $property->sortBy('daily_Lease_Value')->values();
        }
        if ($price == "desc") {
            $property = $property->sortByDesc('daily_Lease_Value')->values();
        }

        return $property;
    }
}
