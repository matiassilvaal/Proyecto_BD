<?php

namespace App\Http\Controllers;
use App\Models\Wallet;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = Wallet::all();
        if($wallets->isEmpty()){
            return response()->json([], 204);
        }
        return response($wallets, 200);
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
                'Cantidad' => 'required|integer',
            ],
            [
                'Cantidad.required' => 'Debes ingresar la cantidad',
                'Cantidad.integer' => 'La cantidad debe ser un entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newWallet = new Wallet();
        $newWallet->Cantidad = $request->Cantidad;
        $newWallet->soft = false;
        $newWallet->save();

        return response()->json([
            'msg' => 'New wallet has been created',
            'id' => $newWallet->id,
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
        $wallet = Wallet::find($id);
        if(empty($wallet)){
            return response()->json([], 204);
        }
        return response($wallet, 200);
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
                'Cantidad' => 'nullable|integer',
            ],
            [
                'Cantidad.integer' => 'La cantidad debe ser un entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $wallet = Wallet::find($id);
        if(empty($wallet)){
            return response()->json([], 204);
        }
        if($request->Cantidad == $wallet->Cantidad){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }
        if (!empty($request->Cantidad)){
            $wallet->Cantidad = $request->Cantidad;
        }
        $wallet->save();
        return response()->json([
            'msg' => 'Wallet has been edited',
            'id' => $wallet->id,
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
        $wallet = Wallet::find($id);
        if(empty($wallet)){
            return response()->json([], 204);
        }
        $wallet->delete();
        return response()->json([
            'msg' => 'Wallet has been deleted',
            'id' => $wallet->id,
        ], 200);
    }
    public function soft($id)
    {
        $wallet = Wallet::find($id);
        if(empty($wallet)){
            return response()->json([], 204);
        }
        if($wallet->soft == true){
          return response()->json([
            'msg' => 'El wallet ya esta borrado (soft deleted)',
            'id' => $wallet->id,
          ], 200);
        }

        $wallet->soft = true;
        $wallet->save();
        return response()->json([
            'msg' => 'Wallet has been soft deleted',
            'id' => $wallet->id,
        ], 200);
    }
    public function restore($id)
    {
        $wallet = Wallet::find($id);
        if(empty($wallet)){
            return response()->json([], 204);
        }
        if($wallet->soft == false){
          return response()->json([
            'msg' => 'El wallet no esta borrado',
            'id' => $wallet->id,
          ], 200);
        }

        $wallet->soft = false;
        $wallet->save();
        return response()->json([
            'msg' => 'Wallet has been restored',
            'id' => $wallet->id,
        ], 200);
    }
}
