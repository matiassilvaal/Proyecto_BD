<?php

namespace App\Http\Controllers;
use App\Models\Method;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class MethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $method = Method::all();
        if($method->isEmpty()){
            return response()->json([], 204);
        }
        return response($method, 200);
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
                'id_tarjeta' => 'required|numeric|exists:App\Models\Card,id',
                'numero' => 'required|numeric|unique:App\Models\Method,numero',
                'nombre' => 'required|string',
                'fecha_de_vencimiento' => 'required|date',
            ],
            [
                'id_tarjeta.required' => 'Debes ingresar un id_tarjeta',
                'numero.required' => 'Debes ingresar un numero de tarjeta',
                'nombre.required' => 'Debes ingresar el nombre de la tarjeta',
                'fecha_de_vencimiento.required' => 'Debes ingresar la fecha de vencimiento',
                'id_tarjeta.numeric' => 'El id_tarjeta debe ser un numero',
                'numero.numeric' => 'El numero de tarjeta debe ser un numero',
                'nombre.string' => 'El nombre debe ser un string',
                'fecha_de_vencimiento.date' => 'La fecha debe ser un date',
                'numero.unique' => 'La tarjeta no se puede repetir',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newMethod = new Method();
        $newMethod->id_tarjeta = $request->id_tarjeta;
        $newMethod->numero = $request->numero;
        $newMethod->nombre = $request->nombre;
        $newMethod->fecha_de_vencimiento = $request->fecha_de_vencimiento;
        $newMethod->soft = false;
        $newMethod->save();

        return response()->json([
            'msg' => 'New method has been created',
            'id' => $newMethod->id,
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
        //
        $method = Method::find($id);
        if(empty($method)){
            return response()->json([], 204);
        }
        return response($method, 200);
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
        //
        $validator = Validator::make(
            $request->all(),
            [
                'id_tarjeta' => 'nullable|integer',
                'numero' => 'nullable|integer',
                'nombre' => 'nullable|string',
                'fecha_de_vencimiento' => 'nullable|date',
            ],
            [
                'id_tarjeta.integer' => 'El id_tarjeta debe ser un numero',
                'numero.integer' => 'El numero de tarjeta debe ser un numero',
                'nombre.string' => 'El nombre debe ser un string',
                'fecha_de_vencimiento.date' => 'La fecha debe ser un date',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $method = Method::find($id);
        if(empty($method)){
            return response()->json([], 204);
        }
        if($request->id_tarjeta == $method->id_tarjeta && $request->numero == $method->numero && $request->nombre == $method->nombre && $request->fecha_de_vencimiento == $method->fecha_de_vencimiento){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }
        if (!empty($request->id_tarjeta)){ // Foranea
            $game = Card::find($request->id_tarjeta);
            if(empty($game)){
                return response()->json([
                    "message" => "No se encontró el id_tarjeta"
                ], 404);
            }
            $method->id_tarjeta = $request->id_tarjeta;
        }
        if (!empty($request->numero)){
            $method->numero = $request->numero;
        }
        if (!empty($request->nombre)){
            $method->nombre = $request->nombre;
        }
        if (!empty($request->fecha_de_vencimiento)){
            $method->fecha_de_vencimiento = $request->fecha_de_vencimiento;
        }
        $method->save();
        return response()->json([
            'msg' => 'Method has been edited',
            'id' => $method->id,
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
        $method = Method::find($id);
        if(empty($method)){
            return response()->json([], 204);
        }
        $method->delete();
        return response()->json([
            'msg' => 'Method has been deleted',
            'id' => $method->id,
        ], 200);
    }
    public function soft($id)
    {
        $method = Method::find($id);
        if(empty($method)){
            return response()->json([], 204);
        }
        if($method->soft == true){
          return response()->json([
            'msg' => 'El method ya esta borrado (soft deleted)',
            'id' => $method->id,
          ], 200);
        }

        $method->soft = true;
        $method->save();
        return response()->json([
            'msg' => 'Method has been soft deleted',
            'id' => $method->id,
        ], 200);
    }
    public function restore($id)
    {
        $method = Method::find($id);
        if(empty($method)){
            return response()->json([], 204);
        }
        if($method->soft == false){
          return response()->json([
            'msg' => 'El method no esta borrado',
            'id' => $method->id,
          ], 200);
        }

        $method->soft = false;
        $method->save();
        return response()->json([
            'msg' => 'Method has been restored',
            'id' => $method->id,
        ], 200);
    }
}
