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
        $ageRestriction = Age_restriction::find($id);
        if(empty($ageRestriction)){
            return response()->json([], 204);
        }

        $ageRestriction->Restriccion = $request->Restriccion;
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
        $ageRestriction = Age_restriction::find($id);
        if(empty($ageRestriction)){
            return response()->json([], 204);
        }
        $ageRestriction->delete();
        return response()->json([
            'msg' => 'Restriction has been deleted',
            'id' => $ageRestriction->id
        ], 200);
    }
}
