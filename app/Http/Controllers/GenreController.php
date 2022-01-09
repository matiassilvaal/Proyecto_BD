<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();
        if($genres->isEmpty()){
            return response()->json([], 204);
        }
        return response($genres, 200);
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
                'Nombre' => 'required|min:4|max:100|unique:App\Models\Genre,Nombre',
            ],
            [
                'Nombre.required' => 'Debes ingresar un nombre',
                'Nombre.min' => 'El genero debe ser almenos de 4 caracteres',
                'Nombre.max' => 'El genero debe ser de maximo 100 caracteres',
                'Nombre.unique' => 'El genero ya existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGenre = new Genre();
        $newGenre->Nombre = $request->Nombre;
        $newGenre->soft = false;
        $newGenre->save();

        return response()->json([
            'msg' => 'New genre has been created',
            'id' => $newGenre->id,
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
        $genre = Genre::find($id);
        if(empty($genre)){
            return response()->json([], 204);
        }
        return response($genre, 200);
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
                'Nombre' => 'required|min:4|max:100|unique:App\Models\Genre,Nombre',
            ],
            [
                'Nombre.required' => 'Debes ingresar un nombre',
                'Nombre.min' => 'El genero debe ser almenos de 4 caracteres',
                'Nombre.max' => 'El genero debe ser de maximo 100 caracteres',
                'Nombre.unique' => 'El genero ya existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $genre = Genre::find($id);
        if(empty($genre)){
            return response()->json([], 204);
        }

        $genre->Nombre = $request->Nombre;
        $genre->save();
        return response()->json([
            'msg' => 'Genre has been edited',
            'id' => $genre->id,
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
        $genre = Genre::find($id);
        if(empty($genre)){
            return response()->json([], 204);
        }
        $genre->delete();
        return response()->json([
            'msg' => 'Genre has been deleted',
            'id' => $genre->id,
        ], 200);
    }
    public function soft($id)
    {
        $genre = Genre::find($id);
        if(empty($genre)){
            return response()->json([], 204);
        }
        if($genre->soft == true){
          return response()->json([
            'msg' => 'El genre ya esta borrado (soft deleted)',
            'id' => $genre->id,
          ], 200);
        }

        $genre->soft = true;
        $genre->save();
        return response()->json([
            'msg' => 'Genre has been soft deleted',
            'id' => $genre->id,
        ], 200);
    }
    public function restore($id)
    {
        $genre = Genre::find($id);
        if(empty($genre)){
            return response()->json([], 204);
        }
        if($genre->soft == false){
          return response()->json([
            'msg' => 'El genre no esta borrado',
            'id' => $genre->id,
          ], 200);
        }

        $genre->soft = false;
        $genre->save();
        return response()->json([
            'msg' => 'Genre has been restored',
            'id' => $genre->id,
        ], 200);
    }
}
