<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use App\Models\Requirement;
use App\Models\Address;
use App\Models\Age_restriction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editarjuego(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'id_publisher' => 'nullable|integer',
                'id_requisito' => 'nullable|integer',
                'id_ubicacion' => 'nullable|integer',
                'id_restriccion' => 'nullable|integer',
                'nombre' => 'nullable|string',
                'precio' => 'nullable|integer|min:0',
                'fecha_de_lanzamiento' => 'nullable|date',
                'descuento' => 'nullable|integer|between:0,100',
                'imagen' => 'nullable|string|max:500|url',
                'descripcion' => 'nullable|string|max:600',
                'descarga' => 'nullable|string|max:600|url',
                'demo' => 'nullable|string|max:600|url'
            ],
            [
                'id_publisher.integer' => 'La id publisher debe ser entera',
                'id_requisito.integer' => 'La id requisito debe ser entera',
                'id_ubicacion.integer' => 'La id ubicacion debe ser entera',
                'id_restriccion.integer' => 'La id restriccion debe ser entera',
                'nombre.string' => 'Nombre debe ser un string',
                'precio.integer' => 'Precio debe ser un entero',
                'precio.min' => 'Precio no puede ser menor a 0',
                'fecha_de_lanzamiento.date' => 'Fecha de lanzamiento debe tener formato date',
                'descuento.integer' => 'Descuento debe ser un entero',
                'descuento.between' => 'Descuento debe estar entre 0 y 100',
                'imagen.string' => 'Imagen debe ser un string',
                'imagen.max' => 'Largo maximo de imagen es 500',
                'imagen.url' => 'Imagen debe ser una url',
                'descripcion.string' => 'La descripcion debe ser un string',
                'descripcion.max' => 'El maximo de caracteres es 600',
                'descarga.string' => 'Descarga debe ser un string',
                'descarga.max' => 'El maximo de caracteres es 600',
                'descarga.url' => 'Descarga es un enlace url',
                'demo.string' => 'Demo debe ser un string',
                'demo.max' => 'El maximo de caracteres es 600',
                'demo.url' => 'Demo es un enlace url'
            ]
        );
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        if($request->id_juego != -1){
            $game = Game::find($request->id_juego); 
        }
        else{
            return back()->withErrors([
                'msg' => 'Tienes que seleccionar un juego'
            ]);
        }

        if(!empty($request->gamePrice)){
            $game->precio = $request->gamePrice;
        }
        if(!empty($request->gameDiscount)){
            $game->descuento = $request->gameDiscount;
        }
        if(!empty($request->gameImage)){
            $game->imagen = $request->gameImage;
        }
        if(!empty($request->gameDescription)){
            $game->descripcion = $request->gameDescription;
        }
        if(!empty($request->gameDownload)){
            $game->descarga = $request->gameDownload;
        }
        if(!empty($request->gameDemo)){
            $game->demo = $request->gameDemo;
        }
        $game->save();
        return redirect()->intended('');
    }
    public function crearjuego(Request $request){
        if (empty(User::find(Auth::guard('publisher')->id()))) {
            return redirect()->intended('');
        }
        if (!empty(User::find(Auth::guard('publisher')->id()))) {
            $user = User::find(Auth::guard('publisher')->id());
        }
        $validator = Validator::make(
            $request->all(),
            [
                'id_direccion' => 'required|exists:App\Models\Address,id',
                'id_restriccion' => 'required|exists:App\Models\Age_restriction,id',
                'gameName' => 'required|string',
                'gamePrice' => 'required|integer|min:0',
                'gameDate' => 'required|date',
                'gameImage' => 'required|string|max:500|url',
                'gameDownload' => 'required|string|max:600|url',
                'gameDemo' => 'required|string|max:600|url'
            ],
            [
                'id_direccion.required' => 'Debes ingresar una ubicacion',
                'id_direccion.exists' => 'La ubicacion no existe',
                'id_restriccion.required' => 'Debes ingresar una restriccion',
                'id_restriccion.exists' => 'La restriccion no existe',
                'gameName.required' => 'Debes ingresar un nombre',
                'gameName.string' => 'Nombre debe ser un string',
                'gamePrice.required' => 'Debes ingresar un precio',
                'gamePrice.integer' => 'Precio debe ser un entero',
                'gamePrice.min' => 'Precio no puede ser menor a 0',
                'gameDate.required' => 'Debes ingresar una fecha de lanazmiento',
                'gameDate.date' => 'Fecha de lanzamiento debe tener formato date',
                'gameImage.required' => 'Debes ingresar una imagen',
                'gameImage.string' => 'Imagen debe ser un string',
                'gameImage.max' => 'Largo maximo de imagen es 500',
                'gameImage.url' => 'Imagen debe ser una url',

                'gameDownload.required' => 'Debes ingresar un link de descarga',
                'gameDownload.string' => 'Descarga debe ser un string',
                'gameDownload.max' => 'El maximo de caracteres es 600',
                'gameDownload.url' => 'Descarga es un enlace url',
                'gameDemo.required' => 'Denes ingresar un link de demo',
                'gameDemo.string' => 'Demo debe ser un string',
                'gameDemo.max' => 'El maximo de caracteres es 600',
                'gameDemo.url' => 'Demo es un enlace url'
            ]
        );
        if($validator->fails()){
            return back()->withErrors($validator->errors());
        }
        $newGame = new Game();
        $newRequirement = new Requirement();
        $newRequirement->SO = $request->reqOS;
        $newRequirement->CPU = $request->reqCPU;
        $newRequirement->RAM = $request->reqRAM;
        $newRequirement->GPU = $request->reqGPU;
        $newRequirement->DirectX = $request->reqDX;
        $newRequirement->RED = $request->reqRED;
        $newRequirement->Uso_de_disco = $request->reqHDD;
        $newRequirement->soft = false;
        $newRequirement->save();
        $newGame->id_publisher = $user->id;
        $newGame->id_requisito = $newRequirement->id;
        $newGame->id_ubicacion = $request->id_direccion;
        $newGame->id_restriccion = $request->id_restriccion;
        $newGame->nombre = $request->gameName;
        $newGame->precio = $request->gamePrice;
        $newGame->fecha_de_lanzamiento = $request->gameDate;
        $newGame->descuento = 0;
        $newGame->imagen = $request->gameImage;
        $newGame->descripcion = $request->gameDescription;
        $newGame->descarga = $request->gameDownload;
        $newGame->demo = $request->gameDemo;
        $newGame->soft = false;
        $newGame->save();

        return redirect()->intended('');
    }
    public function principal(Request $request)
    {
        $juegos = Game::all();
        $usuarios = User::all();
        $requisitos = Requirement::all();
        $direcciones = Address::all();
        $restricciones = Age_restriction::all();
        return view('principal', compact('requisitos', 'direcciones', 'restricciones', 'juegos', 'usuarios'));
    }
    public function fetch()
    {
        $requisitos = Requirement::all();
        $direcciones = Address::all();
        $restricciones = Age_restriction::all();
        return view('create_game', compact('requisitos', 'direcciones', 'restricciones'));
    }
    public function fetchagain()
    {
        $juegos = Game::all();
        if (empty(User::find(Auth::guard('publisher')->id()))) {
            return redirect()->intended('');
        }
        if (!empty(User::find(Auth::guard('publisher')->id()))) {
            $user = User::find(Auth::guard('publisher')->id());
        }
        return view('editarjuego', compact('juegos', 'user'));
    }

    public function datos_crear()
    {
        $requisitos = Requirement::all();
        $direcciones = Address::all();
        $restricciones = Age_restriction::all();
        return view('create', compact('requisitos', 'direcciones', 'restricciones'));
    }
    public function index()
    {
        $games = Game::all();
        if($games->isEmpty()){
            return response()->json([], 204);
        }
        return response($games, 200);
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
                'id_publisher' => 'required|exists:App\Models\User,id|integer',
                'id_requisito' => 'required|exists:App\Models\Requirement,id|integer',
                'id_ubicacion' => 'required|exists:App\Models\Address,id|integer',
                'id_restriccion' => 'required|exists:App\Models\Age_restriction,id|integer',
                'nombre' => 'required|string',
                'precio' => 'required|integer|min:0',
                'fecha_de_lanzamiento' => 'required|date',
                'imagen' => 'required|string|max:500|url',
                'descripcion' => 'required|string|max:600',
                'descarga' => 'required|string|max:600|url',
                'demo' => 'required|string|max:600|url'
            ],
            [
                'id_publisher.required' => 'Debes ingresar una id de usuario (publisher)',
                'id_publisher.exists' => 'La id publisher ya existe',
                'id_publisher.integer' => 'La id publisher debe ser entera',
                'id_requisito.required' => 'Debes ingresar una id requisito',
                'id_requisito.exists' => 'La id requisito ya existe',
                'id_requisito.integer' => 'La id requisito debe ser entera',
                'id_ubicacion.required' => 'Debes ingresar una id ubicacion',
                'id_ubicacion.exists' => 'La id ubicacion ya existe',
                'id_ubicacion.integer' => 'La id ubicacion debe ser entera',
                'nombre.required' => 'Debes ingresar un nombre',
                'nombre.string' => 'Nombre debe ser un string',
                'precio.required' => 'Debes ingresar un precio',
                'precio.integer' => 'Precio debe ser un entero',
                'precio.min' => 'Precio no puede ser menor a 0',
                'fecha_de_lanzamiento.required' => 'Debes ingresar una fecha de lanazmiento',
                'fecha_de_lanzamiento.date' => 'Fecha de lanzamiento debe tener formato date',
                'imagen.required' => 'Debes ingresar una imagen',
                'imagen.string' => 'Imagen debe ser un string',
                'imagen.max' => 'Largo maximo de imagen es 500',
                'imagen.url' => 'Imagen debe ser una url',
                'descripcion.required' => 'Debes ingresar una descripcion',
                'descripcion.string' => 'La descripcion debe ser un string',
                'descripcion.max' => 'El maximo de caracteres es 600',
                'descarga.required' => 'Debes ingresar un link de descarga',
                'descarga.string' => 'Descarga debe ser un string',
                'descarga.max' => 'El maximo de caracteres es 600',
                'descarga.url' => 'Descarga es un enlace url',
                'demo.required' => 'Denes ingresar un link de demo',
                'demo.string' => 'Demo debe ser un string',
                'demo.max' => 'El maximo de caracteres es 600',
                'demo.url' => 'Demo es un enlace url'
            ]
        );
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newGame = new Game();
        $newGame->id_publisher = $request->id_publisher;
        $newGame->id_requisito = $request->id_requisito;
        $newGame->id_ubicacion = $request->id_ubicacion;
        $newGame->id_restriccion = $request->id_restriccion;
        $newGame->nombre = $request->nombre;
        $newGame->precio = $request->precio;
        $newGame->fecha_de_lanzamiento = $request->fecha_de_lanzamiento;
        $newGame->descuento = 0;
        $newGame->imagen = $request->imagen;
        $newGame->descripcion = $request->descripcion;
        $newGame->descarga = $request->descarga;
        $newGame->demo = $request->demo;
        $newGame->soft = false;
        $newGame->save();

        return response()->json([
            'msg' => 'New game has been created',
            'id' => $newGame->id
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
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }
        return response($game, 200);
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
        $validator = Validator::make(
            $request->all(),
            [
                'id_publisher' => 'nullable|integer',
                'id_requisito' => 'nullable|integer',
                'id_ubicacion' => 'nullable|integer',
                'id_restriccion' => 'nullable|integer',
                'nombre' => 'nullable|string',
                'precio' => 'nullable|integer|min:0',
                'fecha_de_lanzamiento' => 'nullable|date',
                'descuento' => 'nullable|integer|between:0,100',
                'imagen' => 'nullable|string|max:500|url',
                'descripcion' => 'nullable|string|max:600',
                'descarga' => 'nullable|string|max:600|url',
                'demo' => 'nullable|string|max:600|url'
            ],
            [
                'id_publisher.integer' => 'La id publisher debe ser entera',
                'id_requisito.integer' => 'La id requisito debe ser entera',
                'id_ubicacion.integer' => 'La id ubicacion debe ser entera',
                'id_restriccion.integer' => 'La id restriccion debe ser entera',
                'nombre.string' => 'Nombre debe ser un string',
                'precio.integer' => 'Precio debe ser un entero',
                'precio.min' => 'Precio no puede ser menor a 0',
                'fecha_de_lanzamiento.date' => 'Fecha de lanzamiento debe tener formato date',
                'descuento.integer' => 'Descuento debe ser un entero',
                'descuento.between' => 'Descuento debe estar entre 0 y 100',
                'imagen.string' => 'Imagen debe ser un string',
                'imagen.max' => 'Largo maximo de imagen es 500',
                'imagen.url' => 'Imagen debe ser una url',
                'descripcion.string' => 'La descripcion debe ser un string',
                'descripcion.max' => 'El maximo de caracteres es 600',
                'descarga.string' => 'Descarga debe ser un string',
                'descarga.max' => 'El maximo de caracteres es 600',
                'descarga.url' => 'Descarga es un enlace url',
                'demo.string' => 'Demo debe ser un string',
                'demo.max' => 'El maximo de caracteres es 600',
                'demo.url' => 'Demo es un enlace url'
            ]
        );
        if($validator->fails()){
            return response($validator->errors());
        }
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }
        if($request->id_publisher == $game->id_publisher && $request->id_requisito == $game->id_requisito && $request->id_requisito == $game->id_requisito && $request->id_restriccion == $game->id_restriccion && $request->nombre == $game->nombre && $request->precio == $game->precio && $request->fecha_de_lanzamiento == $game->fecha_de_lanzamiento){
          if($request->descuento == $game->descuento && $request->imagen == $game->imagen && $request->descripcion == $game->descripcion && $request->descarga == $game->descarga && $request->demo == $game->demo){
            return response()->json([
                'msg' => 'Los datos ingresados son iguales a los actuales'
            ], 404);
          }
        }
        if(!empty($request->id_publisher)){
            $user = User::find($request->id_publisher);
            if(empty($user)){
                return response()->jseon([
                    'msg' => 'No se encontró el id_publisher'
                ], 404);
            }
            $game->id_publisher = $request->publisher;
        }
        if(!empty($request->id_requisito)){
            $user = Requirement::find($request->id_requisito);
            if(empty($id_requisito)){
                return response()->jseon([
                    'msg' => 'No se encontró el id_requisito'
                ], 404);
            }
            $game->id_requisito = $request->id_requisito;
        }
        if(!empty($request->id_ubicacion)){
            $user = Address::find($request->id_ubicacion);
            if(empty($id_ubicacion)){
                return response()->jseon([
                    'msg' => 'No se encontró el id_ubicacion'
                ], 404);
            }
            $game->id_ubicacion = $request->id_ubicacion;
        }
        if(!empty($request->id_restriccion)){
            $user = Age_restriction::find($request->id_restriccion);
            if(empty($id_restriccion)){
                return response()->jseon([
                    'msg' => 'No se encontró el id_restriccion'
                ], 404);
            }
            $game->id_restriccion = $request->id_restriccion;
        }
        if(!empty($request->nombre)){
            $game->nombre = $request->nombre;
        }
        if(!empty($request->precio)){
            $game->precio = $request->precio;
        }
        if(!empty($request->fecha_de_lanzamiento)){
            $game->fecha_de_lanzamiento = $request->fecha_de_lanzamiento;
        }
        if(!empty($request->descuento)){
            $game->descuento = $request->descuento;
        }
        if(!empty($request->imagen)){
            $game->imagen = $request->imagen;
        }
        if(!empty($request->descripcion)){
            $game->descripcion = $request->descripcion;
        }
        if(!empty($request->descarga)){
            $game->descarga = $request->descarga;
        }
        if(!empty($request->demo)){
            $game->demo = $request->demo;
        }
        $game->save();
        return response()->json([
            'msg' => 'Game has been edited',
            'id' => $game->id
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
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }
        $game->delete();
        return response()->json([
            'msg' => 'Game has been deleted',
            'id' => $game->id,
        ], 200);
    }
    public function soft($id)
    {
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }
        if($game->soft == true){
          return response()->json([
            'msg' => 'El game ya esta borrado (soft deleted)',
            'id' => $game->id,
          ], 200);
        }

        $game->soft = true;
        $game->save();
        return response()->json([
            'msg' => 'Game has been soft deleted',
            'id' => $game->id,
        ], 200);
    }
    public function restore($id)
    {
        $game = Game::find($id);
        if(empty($game)){
            return response()->json([], 204);
        }
        if($game->soft == false){
          return response()->json([
            'msg' => 'El game no esta borrado',
            'id' => $game->id,
          ], 200);
        }

        $game->soft = false;
        $game->save();
        return response()->json([
            'msg' => 'Game has been restored',
            'id' => $game->id,
        ], 200);
    }
}
