<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\api\v1\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
<<<<<<< HEAD

=======
>>>>>>> 2057b4843ad0e8ff884573ea3bac2100184b4ba1

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json(auth('sanctum')->user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user = auth('sanctum')->user();
        $user->update($request->all());
        $age = $request->age;

        if($age < 0){
            return response()->json(['message' => 'Las edad ingresada es inválida.'], 400);
        }else{
            if($request->password != null){
                $user->update($request->all());
                $user->password = Hash::make($request->password);
                $user->save();
                return response()->json(['data' => $user], 200);
            }else{
                $user->update($request->all());
                return response()->json(['data' => $user], 200);
            }
        }
        

        /* $user = auth('sanctum')->user();
        $age = $request->age;

        if($age < 0){
            return response()->json(['message' => 'Las edad ingresada es inválida.'], 400);
        }else{
            $user->update($request->all());
            return response()->json(['data' => $user], 200);
<<<<<<< HEAD
        } */
        
=======
        }

>>>>>>> 2057b4843ad0e8ff884573ea3bac2100184b4ba1
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = auth('sanctum')->user();
        $user->delete();
        return response()->json(null);


        /* $user->update($request->all()); */
    }
}
