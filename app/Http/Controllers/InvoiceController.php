<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use App\Models\Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        if($invoices->isEmpty()){
            return response()->json([], 204);
        }
        return response($invoices, 200);
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
                'id_metodo' => 'required|exists:App\Models\Method,id',
                'precio' => 'required|integer|min:0',
            ],
            [
                'id_usuario.required' => 'Debes ingresar una id de usuario',
                'id_usuario.exists' => 'No existe la foranea de id de usuario',
                'id_metodo.required' => 'Debes ingresar una id de metodo',
                'id_metodo.exists' => 'No existe la foranea de id de metodo',
                'precio.required' => 'Se requiere un precio',
                'precio.min' => 'El precio debe ser minimo de 0',
                'precio.integer' => 'El precio debe ser un entero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newInvoice = new Invoice();
        $newInvoice->id_usuario = $request->id_usuario;
        $newInvoice->id_metodo = $request->id_metodo;
        $newInvoice->precio = $request->precio;
        $newInvoice->save();

        return response()->json([
            'msg' => 'New invoice has been created',
            'id' => $newInvoice->id,
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
        $invoice = Invoice::find($id);
        if(empty($invoice)){
            return response()->json([], 204);
        }
        return response($invoice, 200);
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
                'id_metodo' => 'nullable|integer',
                'precio' => 'nullable|integer',
            ],
            [
                'id_usuario.integer' => 'id_usuario debe ser un numero',
                'id_metodo.integer' => 'id_metodo debe ser un numero',
                'precio.integer' => 'precio debe ser un numero',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $invoice = Invoice::find($id);
        if ($request->id_usuario == $invoice->id_usuario && $request->id_metodo == $invoice->id_metodo && $request->precio == $invoice->precio){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        //
        if (!empty($request->id_usuario)){ // Foranea
            $user = User::find($request->id_usuario);
            if(empty($user)){
                return response()->json([
                    "message" => "No se encontró el id_usuario"
                ], 404);
            }
            $invoice->id_usuario = $request->id_usuario;
        }
        if (!empty($request->id_metodo)){ // Foranea
            $method = Method::find($request->id_metodo);
            if(empty($method)){
                return response()->json([
                    "message" => "No se encontró el id_method"
                ], 404);
            }
            $invoice->id_metodo = $request->id_metodo;
        }
        if (!empty($request->precio)){
            $invoice->precio = $request->precio;
        }
        //
        $invoice->save();
        return response()->json([
            'msg' => 'Invoice has been edited',
            'id' => $invoice->id,
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
        $invoice = Invoice::find($id);
        if(empty($invoice)){
            return response()->json([], 204);
        }
        $invoice->delete();
        return response()->json([
            'msg' => 'Invoice has been deleted',
            'id' => $invoice->id,
        ], 200);
    }
}
