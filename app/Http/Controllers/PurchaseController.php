<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
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
