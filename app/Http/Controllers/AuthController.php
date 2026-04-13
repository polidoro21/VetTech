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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {

            $request->session()->regenerate();

            // pega usuário logado
            $user = auth()->user();

            // define tipo
            if ($user->email === 'admin@gmail.com') {
                $user->tipo = 'admin';
            } else {
                $user->tipo = 'user';
            }

            // salva na sessão
            session(['usuario' => $user]);

            return redirect()->route('painel');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')
            ->with('success', 'Cadastro realizado!');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        session()->forget('usuario'); // 🔥 importante

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
