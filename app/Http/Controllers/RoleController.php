<?php

namespace App\Http\Controllers;

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
