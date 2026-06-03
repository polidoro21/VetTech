<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        session(['usuario_logado' => true]);

        return redirect()->route('dashboard');
    }

    public function register(Request $request)
    {
        return redirect()->route('login');
    }

    public function logout()
    {
        session()->forget('usuario_logado');

        return redirect()->route('home');
    }
}
