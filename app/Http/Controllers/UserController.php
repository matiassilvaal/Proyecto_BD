<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Address;
use App\Models\Role;
use App\Models\Currency;
use App\Models\Wallet;
use App\Models\Game;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cuenta(){
        
        if(empty(User::find(Auth::id())) && empty(User::find(Auth::guard('admin')->id())) && empty(User::find(Auth::guard('publisher')->id()))){
            return response()->json([], 404);
        }
        if(!empty(User::find(Auth::id()))){
            $user = User::find(Auth::id());
        }
        else if(!empty(User::find(Auth::guard('admin')->id()))){
            $user = User::find(Auth::guard('admin')->id());
        }
        else if(!empty(User::find(Auth::guard('publisher')->id()))){
            $user = User::find(Auth::guard('publisher')->id());
        }
        $moneda = Currency::find($user->id_moneda);
        $comentarios = Comment::where('id_usuario', $user->id)->get();
        
            $juegos = Game::all();
        return view('mostrardatos', compact('user', 'moneda', 'comentarios', 'juegos'));
    }
    public function authenticate(Request $request)
    {
        $usuario = User::where('email', $request->email)->first();
        if(empty($usuario)){
            return back()->withErrors([
                'email' => 'El correo/contrasena es incorrecto',
            ]);
        }
        if($usuario->id_rol == 3){
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                    return redirect()->intended('');
            }
        }
        if($usuario->id_rol == 2){
            if (Auth::guard('publisher')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                    return redirect()->intended('');
            }
        }
        else{
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
        }
            
        return back()->withErrors([
            'email' => 'El correo/contrasena es incorrecto',
        ]);
    }
    public function index()
    {
        $users = User::all();
        if($users->isEmpty()){
            return response()->json([], 204);
        }
        return view('pruebas', compact('users'));
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
                'id_direccion' => 'required|exists:App\Models\Address,id',
                'id_rol' => 'required|exists:App\Models\Role,id',
                'id_moneda' => 'required|exists:App\Models\Currency,id',
                'id_billetera' => 'required|exists:App\Models\Wallet,id',
                'nombre' => 'required|string|min:4',
                'fecha_de_nacimiento' => 'required|date',
                'moneda' => 'required|integer|min:0',
                'email' => 'required|string|unique:App\Models\User,email',
                'password' => 'required|string|min:4',
            ],
            [
                'id_direccion.required' => 'Debes ingresar una id_direccion',
                'id_rol.required' => 'Debes ingresar una id_rol',
                'id_moneda.required' => 'Debes ingresar una id_moneda',
                'id_billetera.required' => 'Debes ingresar una id_billetera',
                'id_direccion.exists' => 'No existe la foranea id_direccion',
                'id_rol.exists' => 'No existe la foranea id_rol',
                'id_moneda.exists' => 'No existe la foranea id_moneda',
                'id_billetera.exists' => 'No existe la foranea id_billetera',
                'nombre.required' => 'Debe ingresar un nombre',
                'nombre.string' => 'El nombre debe ser un string',
                'nombre.min' => 'Nombre minimo 4 caracteres',
                'fecha_de_nacimiento.required' => 'Debe ingresar una fecha',
                'fecha_de_nacimiento.date' => 'La fecha debe ser una date',
                'moneda.required' => 'Debe ingresar una moneda',
                'moneda.integer' => 'La moneda debe ser entero',
                'moneda.min' => 'El minimo de la moneda es 0',
                'email.required' => 'Debe ingresar un email',
                'email.integer' => 'El email debe ser un string',
                'email.unique' => 'El email es unico',
                'password.required' => 'Debe ingresar una password',
                'password.string' => 'La password debe ser un string',
                'password.min' => 'La password debe tener almenos 4 caracteres',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $newUser = new User();
        $newUser->id_direccion = $request->id_direccion;
        $newUser->id_rol = $request->id_rol;
        $newUser->id_moneda = $request->id_moneda;
        $newUser->id_billetera = $request->id_billetera;
        $newUser->nombre = $request->nombre;
        $newUser->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        $newUser->moneda = $request->moneda;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->soft = false;
        $newUser->save();

        return response()->json([
            'msg' => 'New user has been created',
            'id' => $newUser->id,
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
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }
        return response($user, 200);
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
                'id_direccion' => 'nullable|integer',
                'id_rol' => 'nullable|integer',
                'id_moneda' => 'nullable|integer',
                'id_billetera' => 'nullable|integer',
                'nombre' => 'nullable|string|min:4',
                'fecha_de_nacimiento' => 'nullable|date',
                'moneda' => 'nullable|integer|min:0',
                'email' => 'nullable|string',
                'password' => 'nullable|string|min:4',
            ],
            [
                'id_direccion.integer' => 'id_direccion debe ser entero',
                'id_rol.integer' => 'id_rol debe ser entero',
                'id_moneda.integer' => 'id_moneda debe ser entero',
                'id_billetera.integer' => 'id_billetera debe ser entero',
                'nombre.string' => 'El nombre debe ser un string',
                'nombre.min' => 'Nombre minimo 4 caracteres',
                'fecha_de_nacimiento.date' => 'La fecha debe ser una date',
                'moneda.integer' => 'La moneda debe ser entero',
                'moneda.min' => 'El minimo de la moneda es 0',
                'email.integer' => 'El email debe ser un string',
                'password.string' => 'La password debe ser un string',
                'password.min' => 'La password debe tener almenos 4 caracteres',
            ]
        );
        //Caso falla la validación
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }

        if ($request->id_direccion == $user->id_direccion && $request->id_rol == $user->id_rol && $request->id_moneda == $user->id_moneda && $request->id_billetera == $user->id_billetera){
          if($request->nombre == $user->nombre && $request->fecha_de_nacimiento == $user->fecha_de_nacimiento && $request->moneda == $user->moneda && $request->email == $user->email && $request->password == $user->password){
            return response()->json([
                "message" => "Los datos ingresados son iguales a los actuales."
            ], 404);
          }
        }
        //
        if (!empty($request->id_direccion)){ // Foranea
            $address = Address::find($request->id_direccion);
            if(empty($address)){
                return response()->json([
                    "message" => "No se encontró el id_direccion"
                ], 404);
            }
            $user->id_direccion = $request->id_direccion;
        }
        if (!empty($request->id_rol)){ // Foranea
            $role = Role::find($request->id_rol);
            if(empty($role)){
                return response()->json([
                    "message" => "No se encontró el id_rol"
                ], 404);
            }
            $user->id_rol = $request->id_rol;
        }
        if (!empty($request->id_moneda)){ // Foranea
            $currency = Currency::find($request->id_moneda);
            if(empty($currency)){
                return response()->json([
                    "message" => "No se encontró el id_moneda"
                ], 404);
            }
            $user->id_moneda = $request->id_moneda;
        }
        if (!empty($request->id_billetera)){ // Foranea
            $wallet = Wallet::find($request->id_billetera);
            if(empty($wallet)){
                return response()->json([
                    "message" => "No se encontró el id_billetera"
                ], 404);
            }
            $user->id_billetera = $request->id_billetera;
        }
        if (!empty($request->nombre)){
            $user->nombre = $request->nombre;
        }
        if (!empty($request->fecha_de_nacimiento)){
            $user->fecha_de_nacimiento = $request->fecha_de_nacimiento;
        }
        if (!empty($request->moneda)){
            $user->moneda = $request->moneda;
        }
        if (!empty($request->email)){
            $user->email = $request->email;
        }
        if (!empty($request->password)){
            $user->password = $request->password;
        }
        //
        $user->save();
        return response()->json([
            'msg' => 'User has been edited',
            'id' => $user->id,
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
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }
        $user->delete();
        return response()->json([
            'msg' => 'User has been deleted',
            'id' => $user->id,
        ], 200);
    }
    public function soft($id)
    {
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }
        if($user->soft == true){
          return response()->json([
            'msg' => 'El user ya esta borrado (soft deleted)',
            'id' => $user->id,
          ], 200);
        }

        $user->soft = true;
        $user->save();
        return response()->json([
            'msg' => 'User has been soft deleted',
            'id' => $user->id,
        ], 200);
    }
    public function restore($id)
    {
        $user = User::find($id);
        if(empty($user)){
            return response()->json([], 204);
        }
        if($user->soft == false){
          return response()->json([
            'msg' => 'El user no esta borrado',
            'id' => $user->id,
          ], 200);
        }

        $user->soft = false;
        $user->save();
        return response()->json([
            'msg' => 'User has been restored',
            'id' => $user->id,
        ], 200);
    }
}