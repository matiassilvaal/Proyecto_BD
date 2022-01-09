<?php

namespace App\Http\Controllers;
use App\Models\User_game;
use Illuminate\Http\Request;

class User_gameController extends Controller
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
        $user_game = User_game::find($id);
        if(empty($user_game)){
            return response()->json([], 204);
        }
        $user_game->delete();
        return response()->json([
            'msg' => 'User_game has been deleted',
            'id' => $user_game->id,
        ], 200);
    }
    public function soft($id)
    {
        $user_game = User_game::find($id);
        if(empty($user_game)){
            return response()->json([], 204);
        }
        if($user_game->soft == true){
          return response()->json([
            'msg' => 'La direccion ya esta borrada (soft deleted)',
            'id' => $user_game->id,
          ], 200);
        }

        $user_game->soft = true;
        $user_game->save();
        return response()->json([
            'msg' => 'User_game has been soft deleted',
            'id' => $user_game->id,
        ], 200);
    }
    public function restore($id)
    {
        $user_game = User_game::find($id);
        if(empty($user_game)){
            return response()->json([], 204);
        }
        if($user_game->soft == false){
          return response()->json([
            'msg' => 'La direccion no esta borrada',
            'id' => $user_game->id,
          ], 200);
        }

        $user_game->soft = false;
        $user_game->save();
        return response()->json([
            'msg' => 'User_game has been restored',
            'id' => $user_game->id,
        ], 200);
    }
}
