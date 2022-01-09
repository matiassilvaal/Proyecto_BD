<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Requirement;
use App\Models\Address;
use App\Models\Age_restriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        if($games->isEmpty()){
            return response()->json([], 204);
        }
        return response($games, 200);
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
                'id_publisher' => 'required|exists:App\Models\User,id|integer',
                'id_requisito' => 'required|exists:App\Models\Requirement,id|integer',
                'id_ubicacion' => 'required|exists:App\Models\Address,id|integer',
                'id_restriccion' => 'required|exists:App\Models\Age_restriction,id|integer',
                'precio' => 'required|integer|min:0',
                'fecha_de_lanzamiento' => 'required|date',
                'descuento' => 'required|integer|between:0,100',
                'imagen' => 'required|string|max:500|image',
                'descripcion' => 'required|string|max:600',
                'descarga' => 'required|string|max:600|url',
                'demo' => 'required|string|max:600|url'
            ],
            [
                'id_publisher.required' => 'Debes ingresar una id de usuario (publisher)',
                'id_publisher.exists' => 'La id publisher ya existe',
                'id_publisher.integer' => 'La id publisher debe ser entera',
                'id_requisito.required' => 'Debes ingresar una id requisito',
                'id_requisito.exists' => 'La id requisito ya existe',
                'id_requisito.integer' => 'La id requisito debe ser entera',
                'id_ubicacion.required' => 'Debes ingresar una id ubicacion',
                'id_ubicacion.exists' => 'La id ubicacion ya existe',
                'id_ubicacion.integer' => 'La id ubicacion debe ser entera',
                'precio.required' => 'Debes ingresar un precio',
                'precio.integer' => 'Precio debe ser un entero',
                'precio.min' => 'Precio no puede ser menor a 0',
                'fecha_de_lanzamiento.required' => 'Debes ingresar una fecha de lanazmiento',
                'fecha_de_lanzamiento.date' => 'Fecha de lanzamiento debe tener formato date',
                'descuento.required' => 'Debes ingresar un descuento',
                'descuento.integer' => 'Descuento debe ser un entero',
                'descuento.between' => 'Descuento debe estar entre 0 y 100',
                'imagen.required' => 'Debes ingresar una imagen',
                'imagen.string' => 'Imagen debe ser un string',
                'imagen.max' => 'Largo maximo de imagen es 500',
                'imagen.image' => 'Imagen tiene formato de image',
                'descripcion.required' => 'Debes ingresar una descripcion',
                'descripcion.string' => 'La descripcion debe ser un string',
                'descripcion.max' => 'El maximo de caracteres es 600',
                'descarga.required' => 'Debes ingresar un link de descarga',
                'descarga.string' => 'Descarga debe ser un string',
                'descarga.max' => 'El maximo de caracteres es 600',
                'descarga.url' => 'Descarga es un enlace url',
                'demo.required' => 'Denes ingresar un link de demo',
                'demo.string' => 'Demo debe ser un string',
                'demo.max' => 'El maximo de caracteres es 600',
                'demo.url' => 'Demo es un enlace url'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGame = new Game();
        $newGame->id_publisher = $request->id_publisher;
        $newGame->id_requisito = $request->id_requisito;
        $newGame->id_ubicacion = $request->id_ubicacion;
        $newGame->id_restriccion = $request->id_restriccion;
        $newGame->precio = $request->precio;
        $newGame->fecha_de_lanzamiento = $request->fecha_de_lanzamiento;
        $newGame->descuento = $request->descuento;
        $newGame->imagen = $request->imagen;
        $newGame->descripcion = $request->descripcion;
        $newGame->descarga = $request->descarga;
        $newGame->demo = $request->demo;
        $newGame->soft = false;
        $newGame->save();

        return response()->json([
            'msg' => 'New game has been created',
            'id' => $newGame->id
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
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }
        return response($game, 200);
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
                'id_publisher' => 'required|exists:App\Models\User,id|integer',
                'id_requisito' => 'required|exists:App\Models\Requirement,id|integer',
                'id_ubicacion' => 'required|exists:App\Models\Address,id|integer',
                'id_restriccion' => 'required|exists:App\Models\Age_restriction,id|integer',
                'precio' => 'required|integer|min:0',
                'fecha_de_lanzamiento' => 'required|date',
                'descuento' => 'required|integer|between:0,100',
                'imagen' => 'required|string|max:500|image',
                'descripcion' => 'required|string|max:600',
                'descarga' => 'required|string|max:600|url',
                'demo' => 'required|string|max:600|url'
            ],
            [
                'id_publisher.required' => 'Debes ingresar una id de usuario (publisher)',
                'id_publisher.exists' => 'La id publisher ya existe',
                'id_publisher.integer' => 'La id publisher debe ser entera',
                'id_requisito.required' => 'Debes ingresar una id requisito',
                'id_requisito.exists' => 'La id requisito ya existe',
                'id_requisito.integer' => 'La id requisito debe ser entera',
                'id_ubicacion.required' => 'Debes ingresar una id ubicacion',
                'id_ubicacion.exists' => 'La id ubicacion ya existe',
                'id_ubicacion.integer' => 'La id ubicacion debe ser entera',
                'precio.required' => 'Debes ingresar un precio',
                'precio.integer' => 'Precio debe ser un entero',
                'precio.min' => 'Precio no puede ser menor a 0',
                'fecha_de_lanzamiento.required' => 'Debes ingresar una fecha de lanazmiento',
                'fecha_de_lanzamiento.date' => 'Fecha de lanzamiento debe tener formato date',
                'descuento.required' => 'Debes ingresar un descuento',
                'descuento.integer' => 'Descuento debe ser un entero',
                'descuento.between' => 'Descuento debe estar entre 0 y 100',
                'imagen.required' => 'Debes ingresar una imagen',
                'imagen.string' => 'Imagen debe ser un string',
                'imagen.max' => 'Largo maximo de imagen es 500',
                'imagen.image' => 'Imagen tiene formato de image',
                'descripcion.required' => 'Debes ingresar una descripcion',
                'descripcion.string' => 'La descripcion debe ser un string',
                'descripcion.max' => 'El maximo de caracteres es 600',
                'descarga.required' => 'Debes ingresar un link de descarga',
                'descarga.string' => 'Descarga debe ser un string',
                'descarga.max' => 'El maximo de caracteres es 600',
                'descarga.url' => 'Descarga es un enlace url',
                'demo.required' => 'Denes ingresar un link de demo',
                'demo.string' => 'Demo debe ser un string',
                'demo.max' => 'El maximo de caracteres es 600',
                'demo.url' => 'Demo es un enlace url'
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }

        $game->id_publisher = $request->id_publisher;
        $game->id_requisito = $request->id_requisito;
        $game->id_ubicacion = $request->id_ubicacion;
        $game->id_restriccion = $request->id_restriccion;
        $game->precio = $request->precio;
        $game->fecha_de_lanzamiento = $request->fecha_de_lanzamiento;
        $game->descuento = $request->descuento;
        $game->imagen = $request->imagen;
        $game->descripcion = $request->descripcion;
        $game->descarga = $request->descarga;
        $game->demo = $request->demo;
        $game->save();
        return response()->json([
            'msg' => 'Game has been edited',
            'id' => $game->id
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
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }
        $game->delete();
        return response()->json([
            'msg' => 'Game has been deleted',
            'id' => $game->id,
        ], 200);
    }
    public function soft($id)
    {
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }
        if($game->soft == true){
          return response()->json([
            'msg' => 'El game ya esta borrado (soft deleted)',
            'id' => $game->id,
          ], 200);
        }

        $game->soft = true;
        $game->save();
        return response()->json([
            'msg' => 'Game has been soft deleted',
            'id' => $game->id,
        ], 200);
    }
    public function restore($id)
    {
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }
        if($game->soft == false){
          return response()->json([
            'msg' => 'El game no esta borrado',
            'id' => $game->id,
          ], 200);
        }

        $game->soft = false;
        $game->save();
        return response()->json([
            'msg' => 'Game has been restored',
            'id' => $game->id,
        ], 200);
    }
}
