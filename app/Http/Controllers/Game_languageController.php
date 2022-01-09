<?php

namespace App\Http\Controllers;

use App\Models\Game_language;
use App\Models\Game;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Game_languageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game_languages = Game_language::all();
        if($game_languages->isEmpty()){
            return response()->json([], 204);
        }
        return response($game_languages, 200);
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
                'id_idioma' => 'required|exists:App\Models\Language,id|integer'
            ],
            [
                'id_juego.required' => 'Debes ingresar una id de juego',
                'id_juego.exists' => 'La id juego ya existe',
                'id_juego.integer' => 'La id juego debe ser entera',
                'id_idioma.required' => 'Debes ingresar una id de idioma',
                'id_idioma.exists' => 'La id idioma ya existe',
                'id_idioma.integer' => 'La id idioma debe ser entera'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGameLanguage = new Game_language();
        $newGameLanguage->id_juego = $request->id_juego;
        $newGameLanguage->id_idioma = $request->id_idioma;
        $newGameLanguage->save();

        return response()->json([
            'msg' => 'New game_language has been created',
            'id' => $newGameLanguage->id
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
        $gameLanguage = Game_language::find($id);
        if(empty($gameLanguage)){
            return response()->json([], 204);
        }
        return response($gameLanguage, 200);
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
                'id_idioma' => 'nullable|integer'
            ],
            [
                'id_juego.integer' => 'La id juego debe ser entera',
                'id_idioma.integer' => 'La id idioma debe ser entera'
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $gameLanguage = Game_language::find($id);
        if(empty($gameLanguage)){
            return response()->json([], 204);
        }

        if($request->id_juego == $gameLanguage->id_juego && $request->id_idioma == $gameLanguage->id_idioma){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }

        if(!empty($request->id_juego)){
            $game = Game::find($request->id_juego);
            if(empty($game)){
                return response()->jseon([
                    'msg' => 'No se encontró el id_juego'
                ], 404);
            }
            $gameLanguage->id_juego = $request->id_juego;
        }

        if(!empty($request->id_idioma)){
            $language = Language::find($request->id_idioma);
            if(empty($language)){
                return response()->json([
                    'msg' => 'No se encontró el id_idioma'
                ], 404);
            }
            $gameLanguage->id_idioma = $request->id_idioma;
        }

        $gameLanguage->save();
        return response()->json([
            'msg' => 'Game_language has been edited',
            'id' => $gameLanguage->id
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
        $gameLanguage = Game_language::find($id);
        if(empty($gameLanguage)){
            return response()->json([], 204);
        }
        $gameLanguage->delete();
        return response()->json([
            'msg' => 'Game_language has been deleted',
            'id' => $gameLanguage->id
        ], 200);
    }
}
