<?php

namespace App\Http\Controllers;

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
        //
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
        //
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
