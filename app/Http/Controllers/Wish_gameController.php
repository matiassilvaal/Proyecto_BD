<?php

namespace App\Http\Controllers;
use App\Models\Wish_game;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Wish_gameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // mostrar todo
    {
        $wishes = Wish_game::all();
        if($wishes->isEmpty()){
            return response()->json([], 204);
        }
        return response($wishes, 200);
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
                'id_juego' => 'required|exists:App\Models\Country,id|integer',
                'id_usuario' => 'required|exists:App\Models\User,id|integer',
            ],
            [
                'id_juego.required' => 'Debes ingresar un id del juego',
                'id_juego.exists' => 'La llave foranea no existe',
                'id_juego.integer' => 'La llave foranea debe ser un entero',
                'id_usuario.required' => 'Debes ingresar un id del usuario',
                'id_usuario.exists' => 'La llave foranea no existe',
                'id_usuario.integer' => 'La llave foranea debe ser un entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newWish = new Wish_game();
        $newWish->id_juego = $request->id_juego;
        $newWish->id_usuario = $request->id_usuario;
        $newWish->soft = false;
        $newWish->save();

        return response()->json([
            'msg' => 'New wish game has been created',
            'id' => $newWish->id,
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
        $wish = Wish_game::find($id);
        if(empty($wish)){
            return response()->json([], 204);
        }
        return response($wish, 200);
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
                'id_juego' => 'required|integer',
                'id_usuario' => 'required|integer',
            ],
            [
                'id_juego.required' => 'Debes ingresar un id del juego',
                'id_juego.integer' => 'La llave foranea debe ser un entero',
                'id_usuario.required' => 'Debes ingresar un id del usuario',
                'id_usuario.integer' => 'La llave foranea debe ser un entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $wish = Wish_game::find($id);
        // Si la address esta vacia
        if(empty($wish)){
            return response()->json([], 204);
        }
        // Si lo ingresado es lo mismo que lo actual
        if ($request->id_juego == $wish->id_juego && $request->id_usuario == $wish->id_usuario){

            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        // Aca revisas si esta empty o no
        if (!empty($request->id_juego)){ // Esto es para las foraneas, revisar si en otra tabla existe, acordarse de importar dicha tabla arriba
            $game = Game::find($request->id_juego);
            if(empty($game)){
                return response()->json([
                    "message" => "No se encontró el id_juego"
                ], 404);
            }
            $wish->id_juego = $request->id_juego;
        }
        if (!empty($request->id_usuario)){ // Esto es para las foraneas, revisar si en otra tabla existe, acordarse de importar dicha tabla arriba
            $user = User::find($request->id_usuario);
            if(empty($user)){
                return response()->json([
                    "message" => "No se encontró el id_usuario"
                ], 404);
            }
            $wish->id_usuario = $request->id_usuario;
        }


        //
        $wish->save();
        return response()->json([
            'msg' => 'Wish game has been edited',
            'id' => $wish->id,
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
        $wish = Wish_game::find($id);
        if(empty($wish)){
            return response()->json([], 204);
        }
        $wish->delete();
        return response()->json([
            'msg' => 'Wish game has been deleted',
            'id' => $wish->id,
        ], 200);
    }
    public function soft($id)
    {
        $wish = Wish_game::find($id);
        if(empty($wish)){
            return response()->json([], 204);
        }
        if($wish->soft == true){
          return response()->json([
            'msg' => 'El wish game ya esta borrada (soft deleted)',
            'id' => $wish->id,
          ], 200);
        }

        $wish->soft = true;
        $wish->save();
        return response()->json([
            'msg' => 'Wish game has been soft deleted',
            'id' => $wish->id,
        ], 200);
    }
    public function restore($id)
    {
        $wish = Wish_game::find($id);
        if(empty($wish)){
            return response()->json([], 204);
        }
        if($wish->soft == false){
          return response()->json([
            'msg' => 'El wish game no esta borrado',
            'id' => $wish->id,
          ], 200);
        }

        $wish->soft = false;
        $wish->save();
        return response()->json([
            'msg' => 'Wish game has been restored',
            'id' => $wish->id,
        ], 200);
    }
}
