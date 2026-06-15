<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended($this->redirectPathFor(Auth::user()));
        }

        return back()->withErrors([
            'email' => 'Os dados de acesso estao incorretos.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->merge([
            'tipo' => $request->input('tipo', 'tutor'),
            'phone' => $this->digits($request->input('phone')),
            'cpf' => $this->digits($request->input('cpf')),
            'cep' => $this->digits($request->input('cep')),
            'crmv' => strtoupper((string) $request->input('crmv')),
            'uf' => strtoupper((string) $request->input('uf')),
        ]);

        $request->validate([
            'tipo' => ['required', Rule::in(['tutor', 'vet'])],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'digits_between:10,11'],
            'cpf' => ['required', 'digits:11', 'unique:users,cpf'],
            'crmv' => ['nullable', 'required_if:tipo,vet', 'string', 'max:20'],
            'cep' => ['nullable', 'digits:8'],
            'logradouro' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:20'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'uf' => ['nullable', 'size:2'],
            'password' => ['required', 'confirmed', 'min:8'],
            'terms' => ['accepted'],
        ]);

        User::create([
            'tipo' => $request->tipo,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cpf' => $request->cpf,
            'crmv' => $request->tipo === 'vet' ? $request->crmv : null,
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Cadastro realizado! Faca login para continuar.');
    }

    public function showClinicRegister()
    {
        return view('clinicas.register');
    }

    public function registerClinic(Request $request)
    {
        $request->merge([
            'phone' => $this->digits($request->input('phone')),
            'cnpj' => $this->digits($request->input('cnpj')),
        ]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'digits_between:10,11'],
            'cnpj' => ['required', 'digits:14', 'unique:users,cnpj'],
            'password' => ['required', 'confirmed', 'min:8'],
            'terms' => ['accepted'],
        ]);

        $user = User::create([
            'tipo' => 'clinic',
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'cnpj' => $data['cnpj'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('clinicas.profile')
            ->with('success', 'Conta da clinica criada. Complete os dados publicos para enviar para aprovacao.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function redirectPathFor(User $user): string
    {
        return match ($user->tipo) {
            'admin' => route('admin.clinicas.index', absolute: false),
            'vet' => route('vet.atendimentos.index', absolute: false),
            'clinic' => route('clinicas.profile', absolute: false),
            default => route('dashboard', absolute: false),
        };
    }

    private function digits(?string $value): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $value);

        return $digits === '' ? null : $digits;
    }
}
