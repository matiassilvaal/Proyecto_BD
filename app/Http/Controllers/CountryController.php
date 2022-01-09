<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        if($countries->isEmpty()){
            return response()->json([], 204);
        }
        return response($countries, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'Pais' => 'required|unique:App\Models\Country,Pais|string|min:1|max:100'
            ],
            [
                'Pais.required' => 'Debe ingresar un pais',
                'Pais.unique' => 'Este pais ya existe en la base de datos',
                'Pais.string' => 'Pais debe ser un string',
                'Pais.min' => 'Pais no puede ser vacio',
                'Pais.max' => 'Pais no puede ser mayor de 100 caracteres'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newCountry = new Country();
        $newCountry->Pais = $request->Pais;
        $newCountry->soft = false;
        $newCountry->save();

        return response()->json([
            'msg' => 'New country has been created',
            'id' => $newCountry->id
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        if(empty($country)){
            return response()->json([], 204);
        }
        return response($country, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $validator = Validator::make(
            $request->all(),
            [
                'Pais' => 'unique:App\Models\Country,Pais|string|min:1|max:100'
            ],
            [
                'Pais.unique' => 'Este pais ya existe en la base de datos',
                'Pais.string' => 'Pais debe ser un string',
                'Pais.min' => 'Pais no puede ser vacio',
                'Pais.max' => 'Pais no puede ser mayor de 100 caracteres'
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $country = Country::find($id);
        if(empty($country)){
            return response()->json([], 204);
        }

        if($request->Pais == $country->Pais){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }

        if(!empty($request->Pais)){
            $country->Pais = $request->Pais;
        }
        $country->save();
        return response()->json([
            'msg' => 'Country has been edited',
            'id' => $country->id
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $country = Country::find($id);
        if(empty($country)){
            return response()->json([], 204);
        }
        $country->delete();
        return response()->json([
            'msg' => 'Country has been deleted',
            'id' => $country->id,
        ], 200);
    }
    public function soft($id)
    {
        $country = Country::find($id);
        if(empty($country)){
            return response()->json([], 204);
        }
        if($country->soft == true){
          return response()->json([
            'msg' => 'El country ya esta borrado (soft deleted)',
            'id' => $country->id,
          ], 200);
        }

        $country->soft = true;
        $country->save();
        return response()->json([
            'msg' => 'Country has been soft deleted',
            'id' => $country->id,
        ], 200);
    }
    public function restore($id)
    {
        $country = Country::find($id);
        if(empty($country)){
            return response()->json([], 204);
        }
        if($country->soft == false){
          return response()->json([
            'msg' => 'El country no esta borrado',
            'id' => $country->id,
          ], 200);
        }

        $country->soft = false;
        $country->save();
        return response()->json([
            'msg' => 'Country has been restored',
            'id' => $country->id,
        ], 200);
    }
}
