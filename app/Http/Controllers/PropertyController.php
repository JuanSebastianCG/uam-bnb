<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Characteristic;
use App\Models\Characteristic_of_property;
use App\Http\Traits\QueryTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PropertyRequest;
use App\Models\Photograph;
use App\Models\User;

class PropertyController extends Controller
{
    use QueryTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        $properties = $user->property()
        ->orderBy('created_at', 'desc')->get();

        $photos = Photograph::all();

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

        $qualifications = $this->counterQualification($property->id);

        $characteristic_of_property =  Characteristic_of_property::where('property_id',$property->id )->get();
        $characteristics = collect( new Characteristic);

        foreach ($characteristic_of_property as $characteristic_idFind) {
            $characteristics->add(Characteristic::find($characteristic_idFind->characteristic_id));
        }

        $photos = Photograph::where('property_id',$property->id)->orderBy('created_at','DESC')->paginate(10);
        return view('properties.show', compact('property','user','photos','characteristics','qualifications'));
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
