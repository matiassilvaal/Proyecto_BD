<?php

namespace App\Http\Controllers;

use App\Models\Comment_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Comment_typeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commentTypes = Comment_type::all();
        if($commentTypes->isEmpty()){
            return response()->json([], 204);
        }
        return response($commentTypes, 200);
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
                'Tipo.required' => 'Debes ingresar un tipo de comentario (1: like o 0: dislike)',
                'Tipo.boolean' => 'El tipo debe ser un booleano (true/false, 1/0, "1"/"0")'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newCommentType = new Comment_type();
        if($request->Tipo == true || $request->Tipo == false || $request->Tipo == 1 || $request->Tipo == 0){
          $newCommentType->Tipo = $request->Tipo;
        }
        $newCommentType->soft = false;
        $newCommentType->save();

        return response()->json([
            'msg' => 'New comment type has been created',
            'id' => $newCommentType->id
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
        $commentType = Comment_type::find($id);
        if(empty($commentType)){
            return response()->json([], 204);
        }
        return response($commentType, 200);
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
                'Tipo.required' => 'Debes ingresar un tipo de comentario (1: like o 0: dislike)',
                'Tipo.boolean' => 'El tipo debe ser un booleano (true/false, 1/0, "1"/"0")'
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $commentType = Comment_type::find($id);
        if(empty($commentType)){
            return response()->json([], 204);
        }
        if($request->Tipo == true || $request->Tipo == false || $request->Tipo == 1 || $request->Tipo == 0){
          $commentType->like = $request->like;
        }
        $commentType->save();
        return response()->json([
            'msg' => 'Comment type has been edited',
            'id' => $commentType->id
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
        $comment_type = Comment_type::find($id);
        if(empty($comment_type)){
            return response()->json([], 204);
        }
        $comment_type->delete();
        return response()->json([
            'msg' => 'Comment_type has been deleted',
            'id' => $comment_type->id,
        ], 200);
    }
    public function soft($id)
    {
        $comment_type = Comment_type::find($id);
        if(empty($comment_type)){
            return response()->json([], 204);
        }
        if($comment_type->soft == true){
          return response()->json([
            'msg' => 'El comment_type ya esta borrado (soft deleted)',
            'id' => $comment_type->id,
          ], 200);
        }

        $comment_type->soft = true;
        $comment_type->save();
        return response()->json([
            'msg' => 'Comment_type has been soft deleted',
            'id' => $comment_type->id,
        ], 200);
    }
    public function restore($id)
    {
        $comment_type = Comment_type::find($id);
        if(empty($comment_type)){
            return response()->json([], 204);
        }
        if($comment_type->soft == false){
          return response()->json([
            'msg' => 'El comment_type no esta borrado',
            'id' => $comment_type->id,
          ], 200);
        }

        $comment_type->soft = false;
        $comment_type->save();
        return response()->json([
            'msg' => 'Comment_type has been restored',
            'id' => $comment_type->id,
        ], 200);
    }
}
