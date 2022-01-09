<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Role_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class Role_permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_permission = Role_permission::all();
        if($role_permission->isEmpty()){
            return response()->json([], 204);
        }
        return response($role_permission, 200);
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
                'id_rol' => 'required|exists:App\Models\Role,id',
                'id_permiso' => 'required|exists:App\Models\Permission,id',
            ],
            [
                'id_rol.required' => 'Debes ingresar el id_rol',
                'id_permiso.required' => 'Debes ingresar el id_permiso',
                'id_rol.exists' => 'La llave foranea id_rol no existe',
                'id_permiso.exists' => 'La llave foranea id_permiso no existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newRole_permission = new Role_permission();
        $newRole_permission->id_rol = $request->id_rol;
        $newRole_permission->id_permiso = $request->id_permiso;
        $newRole_permission->soft = false;
        $newRole_permission->save();
        return response()->json([
            'msg' => 'New role_permission has been created',
            'id' => $newRole_permission->id,
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
        $role_permission = Role_permission::find($id);
        if(empty($role_permission)){
            return response()->json([], 204);
        }
        return response($role_permission, 200);
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
                'id_rol' => 'nullable|integer',
                'id_permiso' => 'nullable|integer',
            ],
            [
                'id_rol.integer' => 'id_rol debe ser un entero',
                'id_permiso.integer' => 'id_permiso debe ser un entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $role_permission = Role_permission::find($id);
        if(empty($role_permission)){
            return response()->json([], 204);
        }
        if($request->id_rol == $role_permission->id_rol && $request->id_permiso == $role_permission->id_permiso){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
        }

        if (!empty($request->id_rol)){ // Foranea
            $role = Role::find($request->id_rol);
            if(empty($role)){
                return response()->json([
                    "message" => "No se encontró el id_rol"
                ], 404);
            }
            $role_permission->id_rol = $request->id_rol;
        }
        if (!empty($request->id_permiso)){ // Foranea
            $permission = Permission::find($request->id_permiso);
            if(empty($permission)){
                return response()->json([
                    "message" => "No se encontró el id_permiso"
                ], 404);
            }
            $role_permission->id_permiso = $request->id_permiso;
        }
        $role_permission->save();
        return response()->json([
            'msg' => 'Role permission has been edited',
            'id' => $role_permission->id,
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
        $role_permission = Role_permission::find($id);
        if(empty($role_permission)){
            return response()->json([], 204);
        }
        $role_permission->delete();
        return response()->json([
            'msg' => 'Role_permission has been deleted',
            'id' => $role_permission->id,
        ], 200);
    }
    public function soft($id)
    {
        $role_permission = Role_permission::find($id);
        if(empty($role_permission)){
            return response()->json([], 204);
        }
        if($role_permission->soft == true){
          return response()->json([
            'msg' => 'El role_permission ya esta borrado (soft deleted)',
            'id' => $role_permission->id,
          ], 200);
        }

        $role_permission->soft = true;
        $role_permission->save();
        return response()->json([
            'msg' => 'Role_permission has been soft deleted',
            'id' => $role_permission->id,
        ], 200);
    }
    public function restore($id)
    {
        $role_permission = Role_permission::find($id);
        if(empty($role_permission)){
            return response()->json([], 204);
        }
        if($role_permission->soft == false){
          return response()->json([
            'msg' => 'El role_permission no esta borrado',
            'id' => $role_permission->id,
          ], 200);
        }

        $role_permission->soft = false;
        $role_permission->save();
        return response()->json([
            'msg' => 'Role_permission has been restored',
            'id' => $role_permission->id,
        ], 200);
    }
}
