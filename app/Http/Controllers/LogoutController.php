<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        //cierra la sesion con el helper auth que esta en el metodo logout
        auth()->logout();
        //lo redirecciona a la vista de login
        return redirect()->route('login');
    }
}
