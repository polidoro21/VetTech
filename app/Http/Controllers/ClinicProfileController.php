<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicProfileController extends Controller
{
    public function show()
    {
        $clinica = Clinica::where('user_id', Auth::id())->first();

        return view('clinicas.profile', compact('clinica'));
    }

    public function update(Request $request)
    {
        $data = $this->validatedClinicData($request);
        $clinica = Clinica::where('user_id', Auth::id())->first();

        if (!$clinica) {
            Clinica::create($data + [
                'user_id' => Auth::id(),
                'status' => 'pending',
                'pending_changes' => null,
                'rejection_reason' => null,
            ]);

            return redirect()->route('clinicas.profile')
                ->with('success', 'Dados enviados para aprovacao do administrador.');
        }

        if ($clinica->status === 'approved') {
            $clinica->update([
                'pending_changes' => $data,
                'rejection_reason' => null,
            ]);

            return redirect()->route('clinicas.profile')
                ->with('success', 'Alteracoes enviadas para aprovacao. Os dados publicos continuam iguais ate o admin aprovar.');
        }

        $clinica->update($data + [
            'status' => 'pending',
            'pending_changes' => null,
            'rejection_reason' => null,
        ]);

        return redirect()->route('clinicas.profile')
            ->with('success', 'Dados atualizados e reenviados para aprovacao.');
    }

    private function validatedClinicData(Request $request): array
    {
        $request->merge([
            'telefone' => $this->digits($request->input('telefone')),
            'cep' => $this->digits($request->input('cep')),
            'uf' => strtoupper((string) $request->input('uf')),
            'telemedicina' => $request->boolean('telemedicina'),
            'aberta_agora' => $request->boolean('aberta_agora'),
        ]);

        return $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'tipo' => ['required', 'string', 'max:255'],
            'telefone' => ['nullable', 'digits_between:10,11'],
            'email' => ['nullable', 'email', 'max:255'],
            'cep' => ['nullable', 'digits:8'],
            'logradouro' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:20'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'uf' => ['nullable', 'size:2'],
            'horario_abertura' => ['nullable', 'string', 'max:255'],
            'descricao' => ['nullable', 'string', 'max:2000'],
            'telemedicina' => ['boolean'],
            'aberta_agora' => ['boolean'],
        ]);
    }

    private function digits(?string $value): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $value);

        return $digits === '' ? null : $digits;
    }
}
