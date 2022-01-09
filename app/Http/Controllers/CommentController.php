<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        if($comments->isEmpty()){
            return response()->json([], 204);
        }
        return response($comments, 200);
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
                'id_juego' => 'required|exists:App\Models\Game,id|integer',
                'id_usuario' => 'required|exists:App\Models\User,id|integer',
                'id_comment_type' => 'required|exists:App\Models\Comment_type,id|integer',
                'texto' => 'required|string|min:1|max:1000',
                'fecha_de_creacion' => 'required|date'
            ],
            [
                'id_juego.required' => 'Debes ingresar una id de juego',
                'id_juego.exists' => 'La id juego ya existe',
                'id_juego.integer' => 'La id juego debe ser entera',
                'id_usuario.required' => 'Debes ingresar una id de usuario',
                'id_usuario.exists' => 'La id usuario ya existe',
                'id_usuario.integer' => 'La id usuario debe ser entera',
                'id_comment_type.required' => 'Debes ingresar una id de tipo de comentario',
                'id_comment_type.exists' => 'La id tipo de comentario ya existe',
                'id_comment_type.integer' => 'La id tipo de comentario debe ser entera',
                'texto.required' => 'Debes ingresar texto',
                'texto.string' => 'El comentario debe ser un string',
                'texto.min' => 'El comentario no puede ser vacío',
                'texto.max' => 'El comentario no puede pasarse de los 1000 caracteres',
                'fecha_de_creacion.required' => 'Debes ingresar una fecha de creacion',
                'fecha_de_creacion.date' => 'Debe tener formato de fecha'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newComment = new Comment();
        $newComment->id_juego = $request->id_juego;
        $newComment->id_usuario = $request->id_usuario;
        $newComment->texto = $request->texto;
        $newComment->fecha_de_creacion = $request->fecha_de_creacion;
        $newComment->save();

        return response()->json([
            'msg' => 'New comment has been created',
            'id' => $newComment->id
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
        $comment = Comment::find($id);
        if(empty($comment)){
            return response()->json([], 204);
        }
        return response($comment, 201);
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
                'id_juego' => 'required|exists:App\Models\Game,id|integer',
                'id_usuario' => 'required|exists:App\Models\User,id|integer',
                'id_comment_type' => 'required|exists:App\Models\Comment_type,id|integer',
                'texto' => 'required|string|min:1|max:1000',
                'fecha_de_creacion' => 'required|date'
            ],
            [
                'id_juego.required' => 'Debes ingresar una id de juego',
                'id_juego.exists' => 'La id juego ya existe',
                'id_juego.integer' => 'La id juego debe ser entera',
                'id_usuario.required' => 'Debes ingresar una id de usuario',
                'id_usuario.exists' => 'La id usuario ya existe',
                'id_usuario.integer' => 'La id usuario debe ser entera',
                'id_comment_type.required' => 'Debes ingresar una id de tipo de comentario',
                'id_comment_type.exists' => 'La id tipo de comentario ya existe',
                'id_comment_type.integer' => 'La id tipo de comentario debe ser entera',
                'texto.required' => 'Debes ingresar texto',
                'texto.string' => 'El comentario debe ser un string',
                'texto.min' => 'El comentario no puede ser vacío',
                'texto.max' => 'El comentario no puede pasarse de los 1000 caracteres',
                'fecha_de_creacion.required' => 'Debes ingresar una fecha de creacion',
                'fecha_de_creacion.date' => 'Debe tener formato de fecha'
            ]
        );
        if ($validator->fails()){
            return response($validator->errors());
        }
        $comment = Comment::find($id);
        if(empty($comment)){
            return response()->json([], 204);
        }

        $comment->id_juego = $request->id_juego;
        $comment->id_usuario = $request->id_usuario;
        $comment->id_comment_type = $request->id_comment_type;
        $comment->texto = $request->texto;
        $comment->fecha_de_creacion = $request->fecha_de_creacion;
        $comment->save();
        return response()->json([
            'msg' => 'Comment has been edited',
            'id' => $comment->id
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
        $comment = Comment::find($id);
        if(empty($comment)){
            return response()->json([], 204
            );
        }
        $comment->delete();
        return response()->json([
            'msg' => 'Comment has been deleted',
            'id' => $comment->id
        ], 200);
    }
}
