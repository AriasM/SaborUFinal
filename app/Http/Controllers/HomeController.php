<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Hash;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function registroUsuario(){
        return view('services.registroUsuarios');
    }

    public function usuarioAgregado(){
        return view('mensajes.usuarioagregado')->with('mensaje', ' Usuario agregado correctamente.');
    }

    public function eliminarUsuario(){
        $users = \App\User::all();
        return view('services.eliminarUsuario', compact('users'));
    }

    public function delete(Request $request){
        $user = \App\User::find($request->get('user'));
        $user->delete();
        return view('mensajes.usuarioagregado')->with('mensaje', ' Usuario eliminado correctamente');
    }

    public function modificarUsuario(){
        $users = \App\User::all();
        return view('services.modificarUsuario', compact('users'));
    }

    public function edit($id){
        $user = \App\User::find($id);
        return view('services.edit', compact('user'));
    }

    public function mod(Request $request, $id){
        $nuevoNombre = $request->get('name');
        $nuevoApellido = $request->get('last_name');
        $nuevoEmail = $request->get('email');
        $nuevoRol = $request->get('role');

        $user = \App\User::find($id);

        $user->name = $nuevoNombre;
        $user->last_name = $nuevoApellido;
        $user->email = $nuevoEmail;
        $user->role = $nuevoRol;

        $user->save();

        return view('mensajes.usuarioagregado')->with('mensaje', ' Usuario modificado correctamente');
    }

    public function perfil(){
        return view('services.perfil');
    }

    public function validator_passwords(array $data){
        $messages = [
            'contraseñaActual.required' => 'Debe ingresar la contraseña actual',
            'password.required' => 'Debe ingresar la nueva contraseña',
        ];

        $validator = Validator::make($data, [
            'contraseñaActual' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ]);

        return $validator;
    }

    public function changePassword(Request $request){

        if(Auth::Check()){
            $request_data = $request->All();
            $validator = $this->validator_passwords($request_data);
            if($validator->fails()){
                return redirect('services/perfil')->withErrors( $validator->errors()->add('password', 'Deben coincidir las contraseñas'))->withInput();
            }
            else{
                $contraseñaActual = Auth::User()->password;

                if(Hash::check($request_data['contraseñaActual'], $contraseñaActual)){
                    $user = \App\User::find(Auth::user()->id);
                    $user->password = Hash::make($request_data['password']);
                    $user->save();
                    Auth::logout();
                    return Redirect::to("/");
                }
                else{
                    return redirect('services/perfil')->withErrors( $validator->errors()->add('contraseñaActual', 'Debe ingresar la contraseña actual correcta'))->withInput();
                }
            }
        }

    }

    public function perfilDep(){
        return view('dep.perfil');
    }
}
