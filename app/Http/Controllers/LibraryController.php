<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libraries = Library::all();
        if($libraries->isEmpty()){
            return response()->json([], 204);
        }
        return response($libraries, 200);
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
                'id_juego' => 'required|numeric|exists:App\Models\Game,id',
                'id_usuario' => 'required|numeric|exists:App\Models\User,id',
                'horas_jugadas' => 'required|numeric|min:0',
            ],
            [
                'id_juego.required' => 'Debes ingresar un id_juego',
                'id_usuario.required' => 'Debes ingresar un id_usuario',
                'horas_jugadas.required' => 'Debes ingresar las horas jugadas',
                'id_juego.numeric' => 'El id_juego debe ser un numero',
                'id_usuario.numeric' => 'El id_usuario debe ser un numero',
                'horas_jugadas.numeric' => 'Las horas jugadas deben ser un numero',
                'id_juego.exists' => 'La foranea id_juego debe existir',
                'id_usuario.exists' => 'La foranea id_usuario debe existir',
                'horas_jugadas.min' => 'Las horas de juego deben ser minimo 0',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newLibrary = new Library();
        $newLibrary->id_juego = $request->id_juego;
        $newLibrary->id_usuario = $request->id_usuario;
        $newLibrary->horas_jugadas = $request->horas_jugadas;
        $newLibrary->save();

        return response()->json([
            'msg' => 'New library has been created',
            'id' => $newLibrary->id,
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
        $library = Library::find($id);
        if(empty($library)){
            return response()->json([], 204);
        }
        return response($library, 200);
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
                'id_juego' => 'required|numeric|exists:App\Models\Game,id',
                'id_usuario' => 'required|numeric|exists:App\Models\User,id',
                'horas_jugadas' => 'required|numeric|min:0',
            ],
            [
                'id_juego.required' => 'Debes ingresar un id_juego',
                'id_usuario.required' => 'Debes ingresar un id_usuario',
                'horas_jugadas.required' => 'Debes ingresar las horas jugadas',
                'id_juego.numeric' => 'El id_juego debe ser un numero',
                'id_usuario.numeric' => 'El id_usuario debe ser un numero',
                'horas_jugadas.numeric' => 'Las horas jugadas deben ser un numero',
                'id_juego.exists' => 'La foranea id_juego debe existir',
                'id_usuario.exists' => 'La foranea id_usuario debe existir',
                'horas_jugadas.min' => 'Las horas de juego deben ser minimo 0',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $library = Library::find($id);
        if(empty($library)){
            return response()->json([], 204);
        }
        $library->id_juego = $request->id_juego;
        $library->id_usuario = $request->id_usuario;
        $library->horas_jugadas = $request->horas_jugadas;
        $library->save();
        return response()->json([
            'msg' => 'Library has been edited',
            'id' => $library->id,
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
        $library = Library::find($id);
        if(empty($library)){
            return response()->json([], 204);
        }
        $library->delete();
        return response()->json([
            'msg' => 'Library has been deleted',
            'id' => $library->id,
        ], 200);
    }
}
