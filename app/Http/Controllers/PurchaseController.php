<?php

namespace App\Http\Controllers;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = Purchase::all();
        if($purchase->isEmpty()){
            return response()->json([], 204);
        }
        return response($purchase, 200);
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
                'id_boleta' => 'required|exists:App\Models\Invoice,id',
            ],
            [
                'id_juego.required' => 'Debes ingresar el id_juego',
                'id_boleta.required' => 'Debes ingresar el id_boleta',
                'id_juego.exists' => 'La llave foranea id_juego no existe',
                'id_boleta.exists' => 'La llave foranea id_boleta no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newPurchase = new Permission();
        $newPurchase->id_juego = $request->id_juego;
        $newPurchase->id_boleta = $request->id_boleta;
        $newPurchase->soft = false;
        $newPurchase->save();

        return response()->json([
            'msg' => 'New purchase has been created',
            'id' => $newPurchase->id,
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
        $purchase = Purchase::find($id);
        if(empty($purchase)){
            return response()->json([], 204);
        }
        return response($purchase, 200);
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
                'id_boleta' => 'nullable|integer',
            ],
            [
                'id_juego.integer' => 'id_juego debe ser un entero',
                'id_boleta.integer' => 'id_boleta debe ser un entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $purchase = Purchase::find($id);
        if(empty($purchase)){
            return response()->json([], 204);
        }
        if($request->id_juego == $purchase->id_juego && $request->id_boleta == $purchase->id_boleta){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }

        if (!empty($request->id_juego)){ // Foranea
            $game = Game::find($request->id_juego);
            if(empty($game)){
                return response()->json([
                    "message" => "No se encontró el id_juego"
                ], 404);
            }
            $purchase->id_juego = $request->id_juego;
        }
        if (!empty($request->id_boleta)){ // Foranea
            $invoice = Invoice::find($request->id_boleta);
            if(empty($invoice)){
                return response()->json([
                    "message" => "No se encontró el id_boleta"
                ], 404);
            }
            $purchase->id_boleta = $request->id_boleta;
        }
        $purchase->save();
        return response()->json([
            'msg' => 'Purchase has been edited',
            'id' => $purchase->id,
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
        $purchase = Purchase::find($id);
        if(empty($purchase)){
            return response()->json([], 204);
        }
        $purchase->delete();
        return response()->json([
            'msg' => 'Purchase has been deleted',
            'id' => $purchase->id,
        ], 200);
    }
    public function soft($id)
    {
        $purchase = Purchase::find($id);
        if(empty($purchase)){
            return response()->json([], 204);
        }
        if($purchase->soft == true){
          return response()->json([
            'msg' => 'El purchase ya esta borrado (soft deleted)',
            'id' => $purchase->id,
          ], 200);
        }

        $purchase->soft = true;
        $purchase->save();
        return response()->json([
            'msg' => 'Purchase has been soft deleted',
            'id' => $purchase->id,
        ], 200);
    }
    public function restore($id)
    {
        $purchase = Purchase::find($id);
        if(empty($purchase)){
            return response()->json([], 204);
        }
        if($purchase->soft == false){
          return response()->json([
            'msg' => 'El purchase no esta borrado',
            'id' => $purchase->id,
          ], 200);
        }

        $purchase->soft = false;
        $purchase->save();
        return response()->json([
            'msg' => 'Purchase has been restored',
            'id' => $purchase->id,
        ], 200);
    }
}
