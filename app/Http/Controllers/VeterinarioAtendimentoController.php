<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VeterinarioAtendimentoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $fila = collect();

        if ($user->disponivel_atendimento) {
            $fila = Atendimento::with(['animal.usuario'])
                ->where('status', 'aguardando')
                ->oldest()
                ->get()
                ->reject(fn (Atendimento $atendimento) => in_array($user->id, $atendimento->recusado_por ?? [], true))
                ->values();
        }

        $meusAtendimentos = Atendimento::with(['animal.usuario'])
            ->where('veterinario_id', $user->id)
            ->latest()
            ->get();

        return view('vet.atendimentos.index', compact('fila', 'meusAtendimentos', 'user'));
    }

    public function toggleAvailability(Request $request)
    {
        $data = $request->validate([
            'disponivel_atendimento' => ['required', 'boolean'],
        ]);

        Auth::user()->update([
            'disponivel_atendimento' => (bool) $data['disponivel_atendimento'],
        ]);

        return redirect()->route('vet.atendimentos.index')
            ->with('success', Auth::user()->disponivel_atendimento ? 'Voce esta disponivel para novos atendimentos.' : 'Voce saiu da fila de disponibilidade.');
    }
}
