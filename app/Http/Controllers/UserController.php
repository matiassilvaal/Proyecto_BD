<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
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
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }
        $user->delete();
        return response()->json([
            'msg' => 'User has been deleted',
            'id' => $user->id,
        ], 200);
    }
    public function soft($id)
    {
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }
        if($user->soft == true){
          return response()->json([
            'msg' => 'El user ya esta borrado (soft deleted)',
            'id' => $user->id,
          ], 200);
        }

        $user->soft = true;
        $user->save();
        return response()->json([
            'msg' => 'User has been soft deleted',
            'id' => $user->id,
        ], 200);
    }
    public function restore($id)
    {
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }
        if($user->soft == false){
          return response()->json([
            'msg' => 'El user no esta borrado',
            'id' => $user->id,
          ], 200);
        }

        $user->soft = false;
        $user->save();
        return response()->json([
            'msg' => 'User has been restored',
            'id' => $user->id,
        ], 200);
    }
}
