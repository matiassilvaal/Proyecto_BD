<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequirementController extends Controller
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
        $requirement = Requirement::find($id);
        if(empty($requirement)){
            return response()->json([], 204);
        }
        $requirement->delete();
        return response()->json([
            'msg' => 'Requirement has been deleted',
            'id' => $requirement->id,
        ], 200);
    }
    public function soft($id)
    {
        $requirement = Requirement::find($id);
        if(empty($requirement)){
            return response()->json([], 204);
        }
        if($requirement->soft == true){
          return response()->json([
            'msg' => 'El requirement ya esta borrado (soft deleted)',
            'id' => $requirement->id,
          ], 200);
        }

        $requirement->soft = true;
        $requirement->save();
        return response()->json([
            'msg' => 'Requirement has been soft deleted',
            'id' => $requirement->id,
        ], 200);
    }
    public function restore($id)
    {
        $requirement = Requirement::find($id);
        if(empty($requirement)){
            return response()->json([], 204);
        }
        if($requirement->soft == false){
          return response()->json([
            'msg' => 'El requirement no esta borrado',
            'id' => $requirement->id,
          ], 200);
        }

        $requirement->soft = false;
        $requirement->save();
        return response()->json([
            'msg' => 'Requirement has been restored',
            'id' => $requirement->id,
        ], 200);
    }
}
