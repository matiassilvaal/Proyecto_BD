<?php

namespace App\Http\Controllers;
use App\Models\User_method;
use App\Models\User;
use App\Models\Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class User_methodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_methods = User_method::all();
        if($user_methods->isEmpty()){
            return response()->json([], 204);
        }
        return response($user_methods, 200);
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
                'id_usuario' => 'required|exists:App\Models\User,id',
                'id_tarjeta' => 'required|exists:App\Models\Method,id',
            ],
            [
                'id_usuario.required' => 'Debes ingresar el id_usuario',
                'id_tarjeta.required' => 'Debes ingresar el id_tarjeta',
                'id_usuario.exists' => 'La llave foranea id_usuario no existe',
                'id_tarjeta.exists' => 'La llave foranea id_tarjeta no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newUser_method = new User_method();
        $newUser_method->id_usuario = $request->id_usuario;
        $newUser_method->id_tarjeta = $request->id_tarjeta;
        $newUser_method->soft = false;
        $newUser_method->save();

        return response()->json([
            'msg' => 'New user method has been created',
            'id' => $newUser_method->id,
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
        $user_method = User_method::find($id);
        if(empty($user_method)){
            return response()->json([], 204);
        }
        return response($user_method, 200);
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
                'id_usuario' => 'nullable|integer',
                'id_tarjeta' => 'nullable|integer',
            ],
            [
                'id_usuario.integer' => 'id_usuario debe ser un entero',
                'id_tarjeta.integer' => 'id_tarjeta debe ser un entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $user_method = User_method::find($id);
        if(empty($user_method)){
            return response()->json([], 204);
        }
        if($request->id_usuario == $user_method->id_usuario && $request->id_tarjeta == $user_method->id_tarjeta){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }

        if (!empty($request->id_usuario)){ // Foranea
            $user = User::find($request->id_usuario);
            if(empty($user)){
                return response()->json([
                    "message" => "No se encontró el id_usuario"
                ], 404);
            }
            $user_method->id_usuario = $request->id_usuario;
        }
        if (!empty($request->id_tarjeta)){ // Foranea
            $method = Method::find($request->id_tarjeta);
            if(empty($method)){
                return response()->json([
                    "message" => "No se encontró el id_tarjeta"
                ], 404);
            }
            $user_method->id_tarjeta = $request->id_tarjeta;
        }
        $user_method->save();
        return response()->json([
            'msg' => 'User method has been edited',
            'id' => $user_method->id,
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
