<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MethodController extends Controller
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
        $method = Method::find($id);
        if(empty($method)){
            return response()->json([], 204);
        }
        $method->delete();
        return response()->json([
            'msg' => 'Method has been deleted',
            'id' => $method->id,
        ], 200);
    }
    public function soft($id)
    {
        $method = Method::find($id);
        if(empty($method)){
            return response()->json([], 204);
        }
        if($method->soft == true){
          return response()->json([
            'msg' => 'El method ya esta borrado (soft deleted)',
            'id' => $method->id,
          ], 200);
        }

        $method->soft = true;
        $method->save();
        return response()->json([
            'msg' => 'Method has been soft deleted',
            'id' => $method->id,
        ], 200);
    }
    public function restore($id)
    {
        $method = Method::find($id);
        if(empty($method)){
            return response()->json([], 204);
        }
        if($method->soft == false){
          return response()->json([
            'msg' => 'El method no esta borrado',
            'id' => $method->id,
          ], 200);
        }

        $method->soft = false;
        $method->save();
        return response()->json([
            'msg' => 'Method has been restored',
            'id' => $method->id,
        ], 200);
    }
}
