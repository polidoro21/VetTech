<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            $user = auth()->user();

            // Define tipo do usuário na sessão
            $user->tipo = ($user->email === 'admin@gmail.com') ? 'admin' : 'user';

            session(['usuario' => $user]);

            // CORREÇÃO: rota correta é 'dashboard', não 'painel'
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'E-mail ou senha incorretos.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Cadastro realizado! Faça login para continuar.');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        session()->forget('usuario');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
