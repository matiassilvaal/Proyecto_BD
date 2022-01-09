<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        if($permissions->isEmpty()){
            return response()->json([], 204);
        }
        return response($permissions, 200);
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
                'Permiso' => 'required|string|unique:App\Models\Permission,Permiso',
            ],
            [
                'Permiso.required' => 'Debes ingresar el Permiso',
                'Permiso.string' => 'El Permiso debe ser un string',
                'Permiso.unique' => 'El Permiso no se puede repetir',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newPermission = new Permission();
        $newPermission->Permiso = $request->Permiso;
        $newPermission->soft = false;
        $newPermission->save();

        return response()->json([
            'msg' => 'New permission has been created',
            'id' => $newPermission->id,
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
        $permission = Permission::find($id);
        if(empty($permission)){
            return response()->json([], 204);
        }
        return response($permission, 200);
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
                'Permiso' => 'nullable|string',
            ],
            [
                'nombre.string' => 'El Permiso debe ser un string',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $permission = Permission::find($id);
        if(empty($permission)){
            return response()->json([], 204);
        }
        if($request->Permiso == $permission->Permiso){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }
        if (!empty($request->Permiso)){
            $permission->Permiso = $request->Permiso;
        }
        $permission->save();
        return response()->json([
            'msg' => 'Permission has been edited',
            'id' => $permission->id,
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
        $permission = Permission::find($id);
        if(empty($permission)){
            return response()->json([], 204);
        }
        $permission->delete();
        return response()->json([
            'msg' => 'Permission has been deleted',
            'id' => $permission->id,
        ], 200);
    }
    public function soft($id)
    {
        $permission = Permission::find($id);
        if(empty($permission)){
            return response()->json([], 204);
        }
        if($permission->soft == true){
          return response()->json([
            'msg' => 'El permission ya esta borrado (soft deleted)',
            'id' => $permission->id,
          ], 200);
        }

        $permission->soft = true;
        $permission->save();
        return response()->json([
            'msg' => 'Permission has been soft deleted',
            'id' => $permission->id,
        ], 200);
    }
    public function restore($id)
    {
        $permission = Permission::find($id);
        if(empty($permission)){
            return response()->json([], 204);
        }
        if($permission->soft == false){
          return response()->json([
            'msg' => 'El permission no esta borrado',
            'id' => $permission->id,
          ], 200);
        }

        $permission->soft = false;
        $permission->save();
        return response()->json([
            'msg' => 'Permission has been restored',
            'id' => $permission->id,
        ], 200);
    }
}
