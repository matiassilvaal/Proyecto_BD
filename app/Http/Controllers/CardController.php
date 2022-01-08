<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::all();
        if($cards->isEmpty()){
            return response()->json([], 204);
        }
        return response()->json([], 200);
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
                'Tipo' => 'required|boolean'
            ],
            [
                'Tipo.required' => 'Debes ingresar un tipo de tarjeta',
                'Tipo.boolean' => 'El tipo debe ser un booleano (true/false, 1/0, "1"/"0")'
            ]
        );
        if ($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newCard = new Card();
        $newCard->Tipo = $request->Tipo;
        $newCard->save();

        return response()->json([
            'msg' => 'New card has been created',
            'id' => $newCard->id,
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
        $card = Card::find($id);
        if(empty($card)){
            return response()->json([], 204);
        }
        return response($card, 200);
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
                'Tipo' => 'required|boolean'
            ],
            [
                'Tipo.required' => 'Debes ingresar un tipo de tarjeta',
                'Tipo.boolean' => 'Debe ser un booleano (true/false, 1/0, "1"/"0")'
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $card = Card::find($id);
        if(empty($card)){
            return response()->json([], 204);
        }
        $card->Tipo = $request->Tipo;
        $card->save();
        return response()->json([
            'msg' => 'Card has been edited',
            'id' => $card->id
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
        $card = Card::find($id);
        if(empty($card)){
            return response()->json([], 204);
        }
        $card->delete();
        return response()->json([
            'msg' => 'Card has been deleted',
            'id' => $card->id
        ], 200);
    }
}
