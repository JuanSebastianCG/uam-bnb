<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Characteristic;
use App\Models\Characteristic_of_property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PropertyRequest;
use App\Models\Photograph;

class PropertyController extends Controller
{
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


        return redirect(route('properties.index', $user));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
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
        //
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
