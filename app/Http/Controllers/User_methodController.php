<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User_methodController extends Controller
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
        $user_method = User_method::find($id);
        if(empty($user_method)){
            return response()->json([], 204);
        }
        $user_method->delete();
        return response()->json([
            'msg' => 'User_method has been deleted',
            'id' => $user_method->id,
        ], 200);
    }
    public function soft($id)
    {
        $user_method = User_method::find($id);
        if(empty($user_method)){
            return response()->json([], 204);
        }
        if($user_method->soft == true){
          return response()->json([
            'msg' => 'El user_method ya esta borrado (soft deleted)',
            'id' => $user_method->id,
          ], 200);
        }

        $user_method->soft = true;
        $user_method->save();
        return response()->json([
            'msg' => 'User_method has been soft deleted',
            'id' => $user_method->id,
        ], 200);
    }
    public function restore($id)
    {
        $user_method = User_method::find($id);
        if(empty($user_method)){
            return response()->json([], 204);
        }
        if($user_method->soft == false){
          return response()->json([
            'msg' => 'El user_method no esta borrado',
            'id' => $user_method->id,
          ], 200);
        }

        $user_method->soft = false;
        $user_method->save();
        return response()->json([
            'msg' => 'User_method has been restored',
            'id' => $user_method->id,
        ], 200);
    }
}
