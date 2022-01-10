<?php

namespace App\Http\Controllers;

use App\Models\Age_restriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Age_restrictionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ageRestrictions = Age_restriction::all();
        if($ageRestrictions->isEmpty()){
            return response()->json([], 204);
        }
        return response($ageRestrictions, 200);
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
                'Restriccion' => 'required|numeric|unique:App\Models\Age_restriction,Restriccion|between:3,55'
            ],
            [
                'Restriccion.required' => 'Debes ingresar una edad de restriccion',
                'Restriccion.unique' => 'Esta restricción ya existe',
                'Restriccion.numeric' => 'La restriccion debe ser un numero',
                'Restriccion.between' => 'La restriccion debe estar entre 3 y 55 anos'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newAgeRestriction = new Age_restriction();
        $newAgeRestriction->Restriccion = $request->Restriccion;
        $newAgeRestriction->soft = false;
        $newAgeRestriction->save();

        return response()->json([
            'msg' => 'New age restriction has been created',
            'id' => $newAgeRestriction->id
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
        $ageRestriction = Age_restriction::find($id);
        if(empty($ageRestriction)){
            return response()->json([], 204);
        }
        return response($ageRestriction, 200);
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
                'Restriccion' => 'nullable|integer|unique:App\Models\Age_restriction,Restriccion|between:3,55'
            ],
            [
                'Restriccion.integer' => 'Restriccion debe ser un numero',
                'Restriccion.unique' => 'Ya existe esa restriccion de edad',
                'Restriccion.between' => 'La restriccion debe ser entre 3 y 55'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $ageRestriction = Age_restriction::find($id);
        if(empty($ageRestriction)){
            return response()->json([], 204);
        }

        if($request->Restriccion == $ageRestriction->Restriccion){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales.'
            ], 404);
        }
        if(!empty($request->Restriccion)){
            $ageRestriction->Restriccion = $request->Restriccion;
        }
        $ageRestriction->save();
        return response()->json([
            'msg' => 'Restriction has been edited',
            'id' => $ageRestriction->id
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
        $ageRestriction = Age_restriction::find($id);
        if(empty($ageRestriction)){
            return response()->json([], 204);
        }
        $ageRestriction->delete();
        return response()->json([
            'msg' => 'Age restriction has been deleted',
            'id' => $ageRestriction->id,
        ], 200);
    }
    public function soft($id)
    {
        $ageRestriction = Age_restriction::find($id);
        if(empty($ageRestriction)){
            return response()->json([], 204);
        }
        if($ageRestriction->soft == true){
          return response()->json([
            'msg' => 'La age restriction ya esta borrada (soft deleted)',
            'id' => $ageRestriction->id,
          ], 200);
        }

        $ageRestriction->soft = true;
        $ageRestriction->save();
        return response()->json([
            'msg' => 'Age restriction has been soft deleted',
            'id' => $ageRestriction->id,
        ], 200);
    }
    public function restore($id)
    {
        $ageRestriction = Age_restriction::find($id);
        if(empty($ageRestriction)){
            return response()->json([], 204);
        }
        if($ageRestriction->soft == false){
          return response()->json([
            'msg' => 'El age restriction no esta borrado',
            'id' => $ageRestriction->id,
          ], 200);
        }

        $ageRestriction->soft = false;
        $ageRestriction->save();
        return response()->json([
            'msg' => 'Age restriction has been restored',
            'id' => $ageRestriction->id,
        ], 200);
    }
}
