// Faz o login do usuário
public function login(Request $request)
{
    // Validação dos campos
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Busca usuário pelo email
    $user = User::where('email', $request->email)->first();

    // Verifica se o usuário existe e se a senha confere
    if ($user && Hash::check($request->password, $user->password)) {
        // Autentica o usuário
        auth()->login($user);

        // Redireciona para a página inicial ou dashboard
        return redirect()->route('home')->with('success', 'Login realizado com sucesso!');
    }

    // Se falhar, volta para o login com mensagem de erro
    return redirect()->back()->withErrors(['email' => 'Credenciais inválidas.'])->withInput();
}

 // Faz logout do usuário
public function logout()
{
    auth()->logout();
    return redirect()->route('login')->with('success', 'Você saiu da sessão!');
}
