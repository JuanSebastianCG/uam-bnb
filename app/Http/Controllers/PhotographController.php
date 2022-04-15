<?php

namespace App\Http\Controllers;

use App\Models\Photograph;
use App\Models\User;
use App\Models\Property;
use DB;
use File;

use App\Http\Requests\PhotographRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhotographController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($properties_id)
    {
   
        $property = Property::find($properties_id );
        $user = Auth::user();
        $photos = Photograph::where('property_id',$properties_id )->orderBy('created_at','DESC')->paginate(10);

        return view('photograph.index', compact('photos','user','property'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request)
    {
        $properties_id = request()->get('properties_id');
        return view('photograph.create', compact('properties_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotographRequest $request)
    {
        $properties_id = request()->get('properties_id');

        if ($request->has('images')) {
            foreach ($request->file('images') as $image ) {
                /* nombrar la imagen */
                $imageName = $properties_id.'-image-'.time().rand(1,1000).'.'.$image->extension();
                /* mover al archivo publico */
                $image->move(public_path('property_images'), $imageName);

                /* guardar en la base de datos */
                 Photograph::create([
                    'property_id'=>$properties_id,
                    'url_image'=>$imageName
                 ]);

            }
        }

        return back()->with('added', 'ok');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photograph  $photograph
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photograph $photograph)
    {
        File::delete("property_images/{$photograph->url_image}");
        $photograph->delete();
        return back()->with('deleted', 'ok');
    }
}
