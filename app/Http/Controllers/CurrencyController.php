<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();
        if($currencies->isEmpty()){
            return response()->json([], 204);
        }
        return response($currencies, 200);
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
                'Nombre' => 'required|string|min:1|max:50',
                'Transformacion' => 'required|numeric'
            ],
            [
                'Nombre.required' => 'Debes ingresar un nombre de moneda',
                'Nombre.string' => 'Debe ser un string',
                'Nombre.min' => 'El string no puede ser vacio',
                'Nombre.max' => 'El string no puede ser mayor a 50 caracteres',
                'Transformacion.required' => 'Debes ingresar una tasa de transformacion',
                'Transformacion.numeric' => 'La tasa de transformacion debe ser flotante (2 decimales)'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newCurrency = new Currency();
        $newCurrency->Nombre = $request->Nombre;
        $newCurrency->Transformacion = $request->Transformacion;
        $newCurrency->save();

        return response()->json([
            'msg' => 'New currency has been created',
            'id' => $newCurrency->id
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
        $currency = Currency::find($id);
        if(empty($currency)){
            return response()->json([], 204);
        }
        return response($currency, 200);
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
                'Nombre' => 'nullable|string|min:1|max:50',
                'Transformacion' => 'nullable|numeric'
            ],
            [
                'Nombre.string' => 'Nombre debe ser un string',
                'Nombre.min' => 'El string no puede ser vacio',
                'Nombre.max' => 'El string no puede ser mayor a 50 caracteres',
                'Transformacion.numeric' => 'La tasa de transformacion debe ser flotante (2 decimales)'
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $currency = Currency::find($id);
        if(empty($currency)){
            return response()->json([], 204);
        }

        if($request->Nombre == $currency->Nombre && $request->Transformacion == $currency->Transformacion){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }

        if(!empty($request->Nombre)){
            $currency->Nombre = $request->Nombre;
        }

        if(!empty($request->Transformacion)){
            $request->Transformacion = number_format($request->Transformacion, 2);
            $currency->Transformacion = $request->Transformacion;
        }

        $currency->save();
        return response()->json([
            'msg' => 'Currency has been edited',
            'id' => $currency->id
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
        $currency = Currency::find($id);
        if(empty($currency)){
            return response()->json([], 204);
        }
        $currency->delete();
        return response()->json([
            'msg' => 'Currency has been deleted',
            'id' => $currency->id
        ], 200);
    }
}
