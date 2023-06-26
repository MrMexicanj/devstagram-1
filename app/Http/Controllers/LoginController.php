<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        //muestra la vista de login de usuarios
        return view('auth.login');
    }

    //valida el formulario de login 
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //verifica que las credenciales sean correctas
        if(!auth()->attempt($request->only('email', 'password'))){
            //se utiliza la directiva "with" para llenar los valores de la sesion
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }
        //si las credenciales son correctas 
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
