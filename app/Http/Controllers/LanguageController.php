<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        if($languages->isEmpty()){
            return response()->json([], 204);
        }
        return response($languages, 200);
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
                'Idioma' => 'required|size:2|unique:App\Models\Language,Idioma',
            ],
            [
                'Idioma.required' => 'Debes ingresar un idioma',
                'Idioma.size' => 'El idioma debe ser de 2 caracteres',
                'Idioma.unique' => 'El idioma ya existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newLanguage = new Language();
        $newLanguage->Idioma = $request->Idioma;
        $newLanguage->soft = false;
        $newLanguage->save();

        return response()->json([
            'msg' => 'New language has been created',
            'id' => $newLanguage->id,
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
        $language = Language::find($id);
        if(empty($language)){
            return response()->json([], 204);
        }
        return response($language, 200);
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
                'Idioma' => 'required|size:2|unique:App\Models\Language,Idioma',
            ],
            [
                'Idioma.required' => 'Debes ingresar un idioma',
                'Idioma.size' => 'El idioma debe ser de 2 caracteres',
                'Idioma.unique' => 'El idioma ya existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $language = Language::find($id);
        if(empty($language)){
            return response()->json([], 204);
        }

        $language->Idioma = $request->Idioma;
        $language->save();
        return response()->json([
            'msg' => 'Language has been edited',
            'id' => $language->id,
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
        $language = Language::find($id);
        if(empty($language)){
            return response()->json([], 204);
        }
        $language->delete();
        return response()->json([
            'msg' => 'Language has been deleted',
            'id' => $language->id,
        ], 200);
    }
    public function soft($id)
    {
        $language = Language::find($id);
        if(empty($language)){
            return response()->json([], 204);
        }
        if($language->soft == true){
          return response()->json([
            'msg' => 'El language ya esta borrado (soft deleted)',
            'id' => $language->id,
          ], 200);
        }

        $language->soft = true;
        $language->save();
        return response()->json([
            'msg' => 'Language has been soft deleted',
            'id' => $language->id,
        ], 200);
    }
    public function restore($id)
    {
        $language = Language::find($id);
        if(empty($language)){
            return response()->json([], 204);
        }
        if($language->soft == false){
          return response()->json([
            'msg' => 'El language no esta borrado',
            'id' => $language->id,
          ], 200);
        }

        $language->soft = false;
        $language->save();
        return response()->json([
            'msg' => 'Language has been restored',
            'id' => $language->id,
        ], 200);
    }
}
