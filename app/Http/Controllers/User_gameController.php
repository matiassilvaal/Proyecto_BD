<?php

namespace App\Http\Controllers;
use App\Models\User_game;
use App\Models\User;
use App\Models\Game;
use Illuminate\Http\Request;

class User_gameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_games = User_game::all();
        if($user_games->isEmpty()){
            return response()->json([], 204);
        }
        return response($user_games, 200);
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
                'id_juego' => 'required|exists:App\Models\Game,id',
                'id_usuario' => 'required|exists:App\Models\User,id',
                'like' => 'required|boolean',
                'valoracion' => 'required|integer|min:0|max:5',
            ],
            [
                'id_juego.required' => 'Debes ingresar una id_juego',
                'id_juego.exists' => 'No existe la foranea de id_juego',
                'id_usuario.required' => 'Debes ingresar una id_usuario',
                'id_usuario.exists' => 'No existe la foranea de id_usuario',
                'like.required' => 'Se requiere un like',
                'valoracion.min' => 'La valoracion debe ser minimo de 0',
                'valoracion.max' => 'La valoracion debe ser maximo de 5',
                'valoracion.integer' => 'La valoracion debe ser un entero',
                'like.boolean' => 'El like debe ser un booleano (true/false, 1/0, "1"/"0")'
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newUser_game = new User_game();
        $newUser_game->id_juego = $request->id_juego;
        $newUser_game->id_usuario = $request->id_usuario;
        if($request->like == true || $request->like == false || $request->like == 1 || $request->like == 0){
          $newUser_game->like = $request->like;
        }
        else{
          $newUser_game->like = false;
        }
        $newUser_game->valoracion = $request->valoracion;
        $newUser_game->soft = false;
        $newUser_game->save();

        return response()->json([
            'msg' => 'New user_game has been created',
            'id' => $newUser_game->id,
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
        $user_game = User_game::find($id);
        if(empty($user_game)){
            return response()->json([], 204);
        }
        return response($user_game, 200);
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
                'id_juego' => 'nullable|integer',
                'id_usuario' => 'nullable|integer',
                'like' => 'nullable|boolean',
                'valoracion' => 'nullable|integer|min:0|max:5',
            ],
            [
                'id_juego.integer' => 'id_juego debe ser un numero',
                'id_usuario.integer' => 'id_usuario debe ser un numero',
                'valoracion.min' => 'La valoracion debe ser minimo de 0',
                'valoracion.max' => 'La valoracion debe ser maximo de 5',
                'valoracion.integer' => 'La valoracion debe ser un entero',
                'like.boolean' => 'El like debe ser un booleano (true/false, 1/0, "1"/"0")'
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $user_game = User_game::find($id);
        if(empty($user_game)){
            return response()->json([], 204);
        }

        if ($request->id_juego == $user_game->id_juego && $request->id_usuario == $user_game->id_usuario && $request->like == $user_game->like && $request->valoracion == $user_game->valoracion){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        //
        if (!empty($request->id_juego)){ // Foranea
            $game = Game::find($request->id_juego);
            if(empty($game)){
                return response()->json([
                    "message" => "No se encontró el id_juego"
                ], 404);
            }
            $user_game->id_juego = $request->id_juego;
        }
        if (!empty($request->id_usuario)){ // Foranea
            $user = User::find($request->id_usuario);
            if(empty($user)){
                return response()->json([
                    "message" => "No se encontró el id_usuario"
                ], 404);
            }
            $user_game->id_usuario = $request->id_usuario;
        }
        if($request->like == true || $request->like == false || $request->like == 1 || $request->like == 0){
          $user_game->Tipo = $request->Tipo;
        }
        if (!empty($request->valoracion)){
            $user_game->valoracion = $request->valoracion;
        }
        //
        $user_game->save();
        return response()->json([
            'msg' => 'User game has been edited',
            'id' => $user_game->id,
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
        $user_game = User_game::find($id);
        if(empty($user_game)){
            return response()->json([], 204);
        }
        $user_game->delete();
        return response()->json([
            'msg' => 'User_game has been deleted',
            'id' => $user_game->id,
        ], 200);
    }
    public function soft($id)
    {
        $user_game = User_game::find($id);
        if(empty($user_game)){
            return response()->json([], 204);
        }
        if($user_game->soft == true){
          return response()->json([
            'msg' => 'La direccion ya esta borrada (soft deleted)',
            'id' => $user_game->id,
          ], 200);
        }

        $user_game->soft = true;
        $user_game->save();
        return response()->json([
            'msg' => 'User_game has been soft deleted',
            'id' => $user_game->id,
        ], 200);
    }
    public function restore($id)
    {
        $user_game = User_game::find($id);
        if(empty($user_game)){
            return response()->json([], 204);
        }
        if($user_game->soft == false){
          return response()->json([
            'msg' => 'La direccion no esta borrada',
            'id' => $user_game->id,
          ], 200);
        }

        $user_game->soft = false;
        $user_game->save();
        return response()->json([
            'msg' => 'User_game has been restored',
            'id' => $user_game->id,
        ], 200);
    }
}
