<?php

namespace App\Http\Controllers;

use App\Models\Game_genre;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Game_genreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game_genres = Game_genre::all();
        if($game_genres->isEmpty()){
            return response()->json([], 204);
        }
        return response($game_genres, 200);
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
                'id_juego' => 'required|exists:App\Models\Game,id|integer',
                'id_genero' => 'required|exists:App\Models\Game_genre,id|integer'
            ],
            [
                'id_juego.required' => 'Debes ingresar una id de juego',
                'id_juego.exists' => 'La id juego ya existe',
                'id_juego.integer' => 'La id juego debe ser entera',
                'id_genero.required' => 'Debes ingresar una id de genero',
                'id_genero.exists' => 'La id genero ya existe',
                'id_genero.integer' => 'La id genero debe ser entera'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGameGenre = new Game_genre();
        $newGameGenre->id_juego = $request->id_juego;
        $newGameGenre->id_genero = $request->id_genero;
        $newGameGenre->save();

        return response()->json([
            'msg' => 'New game_genre has been created',
            'id' => $newGameGenre->id
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
        $gameGenre = Game_genre::find($id);
        if(empty($gameGenre)){
            return response()->json([], 204);
        }
        return response($gameGenre, 200);
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
                'id_juego' => 'nullable|integer',
                'id_genero' => 'nullable|integer'
            ],
            [
                'id_juego.integer' => 'La id juego debe ser entera',
                'id_genero.integer' => 'La id genero debe ser entera'
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $gameGenre = Game_genre::find($id);
        if(empty($gameGenre)){
            return response()->json([], 204);
        }

        if($request->id_juego == $gameGenre->id_juego && $request->id_genero == $gameGenre->id_genero){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }

        if(!empty($request->id_juego)){
            $game = Game::find($request->id_juego);
            if(empty($game)){
                return response()->json([
                    'msg' => 'No se encontró la id juego'
                ], 404);
            }
            $gameGenre->id_juego = $request->id_juego;
        }

        if(!empty($request->id_genero)){
            $genre = Genre::find($request->id_genero);
            if(empty($genre)){
                return response()->json([
                    'msg' => 'No se encontró la id del genero'
                ], 404);
            }
            $gameGenre->id_genero = $request->id_genero;
        }

        $gameGenre->save();
        return response()->json([
            'msg' => 'Game_genre has been edited',
            'id' => $gameGenre->id
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
        $gameGenre = Game_genre::find($id);
        if(empty($gameGenre)){
            return response()->json([], 204);
        }
        $gameGenre->delete();
        return response()->json([
            'msg' => 'Game_genre has been deleted',
            'id' => $gameGenre->id
        ], 200);
    }
}
