<?php

namespace App\Http\Controllers;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class RequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requirement = Requirement::all();
        if($requirement->isEmpty()){
            return response()->json([], 204);
        }
        return response($requirement, 200);
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
                'SO' => 'required|string',
                'CPU' => 'required|string',
                'RAM' => 'required|integer',
                'GPU' => 'required|string',
                'DirectX' => 'required|integer',
                'RED' => 'required|string',
                'Uso_de_disco' => 'required|integer',
            ],
            [
                'SO.required' => 'Debes ingresar el SO',
                'CPU.required' => 'Debes ingresar el CPU',
                'RAM.required' => 'Debes ingresar la RAM',
                'GPU.required' => 'Debes ingresar el GPU',
                'DirectX.required' => 'Debes ingresar el DirectX',
                'RED.required' => 'Debes ingresar la RED',
                'Uso_de_disco.required' => 'Debes ingresar el Uso_de_disco',
                'SO.string' => 'SO debe ser string',
                'CPU.string' => 'CPU debe ser string',
                'RAM.integer' => 'RAM debe ser entero',
                'GPU.string' => 'GPU debe ser string',
                'DirectX.integer' => 'DirectX debe ser entero',
                'RED.string' => 'RED debe ser string',
                'Uso_de_disco.integer' => 'Uso de disco debe ser entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newRequirement = new Requirement();
        $newRequirement->SO = $request->SO;
        $newRequirement->CPU = $request->CPU;
        $newRequirement->RAM = $request->RAM;
        $newRequirement->GPU = $request->GPU;
        $newRequirement->DirectX = $request->DirectX;
        $newRequirement->RED = $request->RED;
        $newRequirement->Uso_de_disco = $request->Uso_de_disco;
        $newRequirement->soft = false;
        $newRequirement->save();
        return response()->json([
            'msg' => 'New requirement has been created',
            'id' => $newRequirement->id,
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
        $requirement = Requirement::find($id);
        if(empty($requirement)){
            return response()->json([], 204);
        }
        return response($requirement, 200);
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
                'SO' => 'nullable|string',
                'CPU' => 'nullable|string',
                'RAM' => 'nullable|integer',
                'GPU' => 'nullable|string',
                'DirectX' => 'nullable|integer',
                'RED' => 'nullable|string',
                'Uso_de_disco' => 'nullable|integer',
            ],
            [
                'SO.string' => 'SO debe ser string',
                'CPU.string' => 'CPU debe ser string',
                'RAM.integer' => 'RAM debe ser entero',
                'GPU.string' => 'GPU debe ser string',
                'DirectX.integer' => 'DirectX debe ser entero',
                'RED.string' => 'RED debe ser string',
                'Uso_de_disco.integer' => 'Uso de disco debe ser entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $requirement = Requirement::find($id);
        if(empty($requirement)){
            return response()->json([], 204);
        }
        if($request->SO == $requirement->SO && $request->CPU == $requirement->CPU && $request->RAM == $requirement->RAM && $request->GPU == $requirement->GPU && $request->DirectX == $requirement->DirectX){
          if($request->RED == $requirement->RED && $request->Uso_de_disco == $requirement->Uso_de_disco){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
          }
        }
        if (!empty($request->SO)){
            $requirement->SO = $request->SO;
        }
        if (!empty($request->CPU)){
            $requirement->CPU = $request->CPU;
        }
        if (!empty($request->RAM)){
            $requirement->RAM = $request->RAM;
        }
        if (!empty($request->GPU)){
            $requirement->GPU = $request->GPU;
        }
        if (!empty($request->DirectX)){
            $requirement->DirectX = $request->DirectX;
        }
        if (!empty($request->RED)){
            $requirement->RED = $request->RED;
        }
        if (!empty($request->Uso_de_disco)){
            $requirement->Uso_de_disco = $request->Uso_de_disco;
        }
        $requirement->save();
        return response()->json([
            'msg' => 'Requirement has been edited',
            'id' => $requirement->id,
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
