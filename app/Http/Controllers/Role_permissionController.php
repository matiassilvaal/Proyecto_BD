<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Role_permissionController extends Controller
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
