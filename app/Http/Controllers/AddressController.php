<?php

namespace App\Http\Controllers;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Database\Eloquent\SoftDeletes;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // mostrar todo
    {
        $addresses = Address::all();
        if($addresses->isEmpty()){
            //No hay cursos
            return response()->json([], 204);
        }
        return response($addresses, 200);
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
                'id_pais' => 'required|exists:App\Models\Country,id|integer',
                'ciudad' => 'required|min:4|max:100|unique:App\Models\Address,ciudad',
            ],
            [
                'id_pais.required' => 'Debes ingresar un id del pais',
                'id_pais.exists' => 'La llave foranea no existe',
                'id_pais.integer' => 'La llave foranea debe ser un entero',
                'ciudad.required' => 'Debes ingresar una ciudad',
                'ciudad.min' => 'La ciudad debe ser almenos de 4 caracteres',
                'ciudad.max' => 'La ciudad debe ser de maximo 100 caracteres',
                'ciudad.unique' => 'La ciudad ya existe',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newAddress = new Address();
        $newAddress->id_pais = $request->id_pais;
        $newAddress->ciudad = $request->ciudad;
        $newAddress->save();

        return response()->json([
            'msg' => 'New address has been created',
            'id' => $newAddress->id,
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
        $address = Address::find($id);
        if(empty($address)){
            return response()->json([], 204);
        }
        return response($address, 200);
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
                'id_pais' => 'nullable|integer',
                'ciudad' => 'nullable|min:4|max:100',
            ],
            [
                'id_pais.integer' => 'id_pais debe ser un numero',
                'ciudad.min' => 'La ciudad debe ser almenos de 4 caracteres',
                'ciudad.max' => 'La ciudad debe ser de maximo 100 caracteres',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors());
        }
        $address = Address::find($id);
        // Si la address esta vacia
        if(empty($address)){
            return response()->json([], 204);
        }
        // Si lo ingresado es lo mismo que lo actual
        if ($request->id_pais == $address->id_pais && $request->ciudad == $address->ciudad){

            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
        }
        // Aca revisas si esta empty o no
        if (!empty($request->id_pais)){ // Esto es para las foraneas, revisar si en otra tabla existe, acordarse de importar dicha tabla arriba
            $country = Country::find($request->id_pais);
            if(empty($country)){
                return response()->json([
                    "message" => "No se encontró el id_pais"
                ], 404);
            }
            $address->id_pais = $request->id_pais;
        }
        if (!empty($request->ciudad)){
            $address->ciudad = $request->ciudad;
        }
        //
        $address->save();
        return response()->json([
            'msg' => 'Address has been edited',
            'id' => $address->id,
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
        $address = Address::find($id);
        if(empty($address)){
            return response()->json([], 204);
        }
        $address->delete();
        return response()->json([
            'msg' => 'Address has been deleted',
            'id' => $address->id,
        ], 200);
    }
    public function soft($id)
    {
        $address = Address::find($id);
        if(empty($address)){
            return response()->json([], 204);
        }
        if($address->soft == true){
          return response()->json([
            'msg' => 'La direccion ya esta borrada (soft deleted)',
            'id' => $address->id,
          ], 200);
        }

        $address->soft = true;
        $address->save();
        return response()->json([
            'msg' => 'Address has been soft deleted',
            'id' => $address->id,
        ], 200);
    }
    public function restore($id)
    {
        $address = Address::find($id);
        if(empty($address)){
            return response()->json([], 204);
        }
        if($address->soft == false){
          return response()->json([
            'msg' => 'La direccion no esta borrada',
            'id' => $address->id,
          ], 200);
        }

        $address->soft = false;
        $address->save();
        return response()->json([
            'msg' => 'Address has been restored',
            'id' => $address->id,
        ], 200);
    }
}
