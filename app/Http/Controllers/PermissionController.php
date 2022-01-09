<?php

namespace App\Http\Controllers;

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
