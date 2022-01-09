<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        if($roles->isEmpty()){
            return response()->json([], 204);
        }
        return response($roles, 200);
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
                'Nombre' => 'required|min:4|max:100|unique:App\Models\Role,Nombre',
            ],
            [
                'Nombre.required' => 'Debes ingresar un nombre',
                'Nombre.min' => 'El nombre debe ser almenos de 4 caracteres',
                'Nombre.max' => 'El nombre debe ser de maximo 100 caracteres',
                'Nombre.unique' => 'El nombre ya existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newRole = new Role();
        $newRole->Nombre = $request->Nombre;
        $newRole->soft = false;
        $newRole->save();

        return response()->json([
            'msg' => 'New role has been created',
            'id' => $newRole->id,
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
        $role = Role::find($id);
        if(empty($role)){
            return response()->json([], 204);
        }
        return response($role, 200);
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
                'Nombre' => 'nullable|string|min:4|max:100',
            ],
            [
                'Nombre.min' => 'El nombre debe ser almenos de 4 caracteres',
                'Nombre.max' => 'El nombre debe ser de maximo 100 caracteres',
                'Nombre.string' => 'El nombre debe ser un string',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $role = Role::find($id);
        if(empty($role)){
            return response()->json([], 204);
        }
        if($request->Nombre == $role->Nombre){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }
        if(!empty($request->Nombre)){
            $role->Nombre = $request->Nombre;
        }
        $role->save();
        return response()->json([
            'msg' => 'Role has been edited',
            'id' => $role->id,
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
        $role = Role::find($id);
        if(empty($role)){
            return response()->json([], 204);
        }
        $role->delete();
        return response()->json([
            'msg' => 'Role has been deleted',
            'id' => $role->id,
        ], 200);
    }
    public function soft($id)
    {
        $role = Role::find($id);
        if(empty($role)){
            return response()->json([], 204);
        }
        if($role->soft == true){
          return response()->json([
            'msg' => 'El role ya esta borrado (soft deleted)',
            'id' => $role->id,
          ], 200);
        }

        $role->soft = true;
        $role->save();
        return response()->json([
            'msg' => 'Role has been soft deleted',
            'id' => $role->id,
        ], 200);
    }
    public function restore($id)
    {
        $role = Role::find($id);
        if(empty($role)){
            return response()->json([], 204);
        }
        if($role->soft == false){
          return response()->json([
            'msg' => 'El role no esta borrado',
            'id' => $role->id,
          ], 200);
        }

        $role->soft = false;
        $role->save();
        return response()->json([
            'msg' => 'Role has been restored',
            'id' => $role->id,
        ], 200);
    }
}
