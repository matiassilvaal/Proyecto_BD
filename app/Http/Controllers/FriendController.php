<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Friend::all();
        if($friends->isEmpty()){
            return response()->json([], 204);
        }
        return response($friends, 200);
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
                'id_usuario1' => 'required|exists:App\Models\User,id|integer',
                'id_usuario2' => 'required|exists:App\Models\User,id|integer'
            ],
            [
                'id_usuario1.required' => 'Debes ingresar una id de usuario1',
                'id_usuario1.exists' => 'No existe la foranea de usuario 1',
                'id_usuario1.integer' => 'La id 1 debe ser entera',
                'id_usuario2.required' => 'Debes ingresar una id de usuario2',
                'id_usuario2.exists' => 'No existe la foranea de usuario 2',
                'id_usuario2.integer' => 'La id 2 debe ser entera',
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newFriend = new Friend();
        $newFriend->id_usuario1 = $request->id_usuario1;
        $newFriend->id_usuario2 = $request->id_usuario2;
        $newFriend->soft = false;
        $newFriend->save();

        return response()->json([
            'msg' => 'New friend has been created',
            'id' => $newFriend->id
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
        $friend = Friend::find($id);
        if(empty($friend)){
            return response()->json([], 204);
        }
        return response($friend, 200);
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
                'id_usuario1' => 'nullable|integer',
                'id_usuario2' => 'nullable|integer'
            ],
            [
                'id_usuario1.integer' => 'La id 1 debe ser entera',
                'id_usuario2.integer' => 'La id 2 debe ser entera',
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $friend = Friend::find($id);
        if(empty($friend)){
            return response()->json([], 204);
        }

        if($request->id_usuario1 == $friend->id_usuario1 && $request->id_usuario2 == $friend->id_usuario2){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }

        if(!empty($request->id_usuario1)){
            $user1 = User::find($request->id_usuario1);
            if(empty($user1)){
                return response()->json([
                    'msg' => 'No se encontró el usuario 1'
                ], 404);
            }
            $friend->id_usuario1 = $request->id_usuario1;
        }

        if(!empty($request->id_usuario2)){
            $user2 = User::find($request->id_usuario2);
            if(empty($user2)){
                return response()->json([
                    'msg' => 'No se encontró el usuario 2'
                ], 404);
            }
            $friend->id_usuario2 = $request->id_usuario2;
        }

        $friend->save();
        return response()->json([
            'msg' => 'Friend has been edited',
            'id' => $friend->id
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
        $friend = Friend::find($id);
        if(empty($friend)){
            return response()->json([], 204);
        }
        $friend->delete();
        return response()->json([
            'msg' => 'Friend has been deleted',
            'id' => $friend->id
        ], 200);
    }
}
