<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        if($users->isEmpty()){
            return response()->json([], 204);
        }
        return response($users, 200);
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
                'id_direccion' => 'required|exists:App\Models\Address,id',
                'id_rol' => 'required|exists:App\Models\Role,id',
                'id_moneda' => 'required|exists:App\Models\Currency,id',
                'id_billetera' => 'required|exists:App\Models\Wallet,id',
                'nombre' => 'required|string|min:4',
                'fecha_de_nacimiento' => 'required|date',
                'moneda' => 'required|integer|min:0',
                'correo' => 'required|string|unique:App\Models\User,correo',
                'contrasena' => 'required|string|min:4',
            ],
            [
                'id_direccion.required' => 'Debes ingresar una id_direccion',
                'id_rol.required' => 'Debes ingresar una id_rol',
                'id_moneda.required' => 'Debes ingresar una id_moneda',
                'id_billetera.required' => 'Debes ingresar una id_billetera',
                'id_direccion.exists' => 'No existe la foranea id_direccion',
                'id_rol.exists' => 'No existe la foranea id_rol',
                'id_moneda.exists' => 'No existe la foranea id_moneda',
                'id_billetera.exists' => 'No existe la foranea id_billetera',
                'nombre.required' => 'Debe ingresar un nombre',
                'nombre.string' => 'El nombre debe ser un string',
                'nombre.min' => 'Nombre minimo 4 caracteres',
                'fecha_de_nacimiento.required' => 'Debe ingresar una fecha',
                'fecha_de_nacimiento.date' => 'La fecha debe ser una date',
                'moneda.required' => 'Debe ingresar una moneda',
                'moneda.integer' => 'La moneda debe ser entero',
                'moneda.min' => 'El minimo de la moneda es 0',
                'correo.required' => 'Debe ingresar un correo',
                'correo.integer' => 'El correo debe ser un string',
                'correo.unique' => 'El correo es unico',
                'contrasena.required' => 'Debe ingresar una contrasena',
                'contrasena.string' => 'La contrasena debe ser un string',
                'contrasena.min' => 'La contrasena debe tener almenos 4 caracteres',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newUser = new User();
        $newUser->id_direccion = $request->id_direccion;
        $newUser->id_rol = $request->id_rol;
        $newUser->id_moneda = $request->id_moneda;
        $newUser->id_billetera = $request->id_billetera;
        $newUser->nombre = $request->nombre;
        $newUser->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        $newUser->moneda = $request->moneda;
        $newUser->correo = $request->correo;
        $newUser->contrasena = $request->contrasena;
        $newUser->soft = false;
        $newUser->save();

        return response()->json([
            'msg' => 'New user has been created',
            'id' => $newUser->id,
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
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }
        return response($user, 200);
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
                'id_direccion' => 'nullable|integer',
                'id_rol' => 'nullable|integer',
                'id_moneda' => 'nullable|integer',
                'id_billetera' => 'nullable|integer',
                'nombre' => 'nullable|string|min:4',
                'fecha_de_nacimiento' => 'nullable|date',
                'moneda' => 'nullable|integer|min:0',
                'correo' => 'nullable|string',
                'contrasena' => 'nullable|string|min:4',
            ],
            [
                'id_direccion.integer' => 'id_direccion debe ser entero',
                'id_rol.integer' => 'id_rol debe ser entero',
                'id_moneda.integer' => 'id_moneda debe ser entero',
                'id_billetera.integer' => 'id_billetera debe ser entero',
                'nombre.string' => 'El nombre debe ser un string',
                'nombre.min' => 'Nombre minimo 4 caracteres',
                'fecha_de_nacimiento.date' => 'La fecha debe ser una date',
                'moneda.integer' => 'La moneda debe ser entero',
                'moneda.min' => 'El minimo de la moneda es 0',
                'correo.integer' => 'El correo debe ser un string',
                'contrasena.string' => 'La contrasena debe ser un string',
                'contrasena.min' => 'La contrasena debe tener almenos 4 caracteres',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }

        if ($request->id_direccion == $user->id_direccion && $request->id_rol == $user->id_rol && $request->id_moneda == $user->id_moneda && $request->id_billetera == $user->id_billetera){
          if($request->nombre == $user->nombre && $request->fecha_de_nacimiento == $user->fecha_de_nacimiento && $request->moneda == $user->moneda && $request->correo == $user->correo && $request->contrasena == $user->contrasena){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
          }
        }
        //
        if (!empty($request->id_direccion)){ // Foranea
            $address = Address::find($request->id_direccion);
            if(empty($address)){
                return response()->json([
                    "message" => "No se encontró el id_direccion"
                ], 404);
            }
            $user->id_direccion = $request->id_direccion;
        }
        if (!empty($request->id_rol)){ // Foranea
            $role = Role::find($request->id_rol);
            if(empty($role)){
                return response()->json([
                    "message" => "No se encontró el id_rol"
                ], 404);
            }
            $user->id_rol = $request->id_rol;
        }
        if (!empty($request->id_moneda)){ // Foranea
            $currency = Currency::find($request->id_moneda);
            if(empty($currency)){
                return response()->json([
                    "message" => "No se encontró el id_moneda"
                ], 404);
            }
            $user->id_moneda = $request->id_moneda;
        }
        if (!empty($request->id_billetera)){ // Foranea
            $wallet = Wallet::find($request->id_billetera);
            if(empty($wallet)){
                return response()->json([
                    "message" => "No se encontró el id_billetera"
                ], 404);
            }
            $user->id_billetera = $request->id_billetera;
        }
        if (!empty($request->nombre)){
            $user->nombre = $request->nombre;
        }
        if (!empty($request->fecha_de_nacimiento)){
            $user->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        }
        if (!empty($request->moneda)){
            $user->moneda = $request->moneda;
        }
        if (!empty($request->correo)){
            $user->correo = $request->correo;
        }
        if (!empty($request->contrasena)){
            $user->contrasena = $request->contrasena;
        }
        //
        $user->save();
        return response()->json([
            'msg' => 'User has been edited',
            'id' => $user->id,
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
