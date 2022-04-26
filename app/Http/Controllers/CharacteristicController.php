<?php

namespace App\Http\Controllers;

use App\Models\Characteristic;
use Illuminate\Http\Request;
use App\Http\Requests\CharacteristicRequest;
use Illuminate\Support\Facades\DB;

class CharacteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();
        $characteristics = DB::table('characteristics')->simplePaginate(3);
        return view('characteristics.index', compact('characteristics', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('characteristics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CharacteristicRequest $request)
    {
        $user = Auth()->user();
        if($user->status == 'admin'){
            $characteristic = new Characteristic();
            $characteristic->fill($request->input());
            $characteristic->save();
            $creado = true;
            return redirect('/characteristics');
        }else{
            return redirect('/properties');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function show(CharacteristicRequest $request, Characteristic $characteristic)
    {
        $user = Auth()->user();
        if($user->status == 'admin'){
            $characteristic->fill($request->input());
            $characteristic->save();
            $comprobado = false;
            return redirect('/characteristics');
        }else{
            return redirect('/properties');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function edit(Characteristic $characteristic)
    {
        return view('characteristics.edit', compact('characteristic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function update(CharacteristicRequest $request, Characteristic $characteristic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Characteristic  $characteristic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Characteristic $characteristic)
    {
        $user = Auth()->user();
        if($user->status == 'admin'){
            $characteristic->delete();
            return redirect('/characteristics');
        }else{
            return redirect('/properties');
        }
    }
}
