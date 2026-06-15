<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Atendimento;
use App\Models\Clinica;
use App\Models\Vacina;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->tipo === 'admin') {
            return redirect()->route('admin.clinicas.index');
        }

        if ($user->tipo === 'vet') {
            return redirect()->route('vet.atendimentos.index');
        }

        if ($user->tipo === 'clinic') {
            return redirect()->route('clinicas.profile');
        }

        $userId = Auth::id();

        $animais = Animal::where('id_usuario', $userId)
            ->latest()
            ->take(4)
            ->get();

        $totalAnimais = Animal::where('id_usuario', $userId)->count();

        $atendimentos = Atendimento::with(['animal', 'veterinario'])
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        $totalAtendimentos = Atendimento::where('user_id', $userId)->count();
        $atendimentosAbertos = Atendimento::where('user_id', $userId)
            ->whereIn('status', ['aguardando', 'em_atendimento'])
            ->count();

        $clinicas = Clinica::approved()
            ->orderByRaw('distancia is null')
            ->orderBy('distancia')
            ->orderBy('nome')
            ->take(4)
            ->get();

        $totalClinicas = Clinica::approved()->count();

        $vacinasRecentes = Vacina::with('animal')
            ->whereHas('animal', fn ($query) => $query->where('id_usuario', $userId))
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Vacina $vacina) => [
                'titulo' => 'Vacina registrada',
                'descricao' => $vacina->nome . ' para ' . ($vacina->animal->nome ?? 'pet'),
                'data' => $vacina->created_at,
                'icone' => 'syringe',
                'cor' => 'bg-accent-light',
                'cor_icone' => 'text-accent',
            ]);

        $atendimentosRecentes = Atendimento::with('animal')
            ->where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Atendimento $atendimento) => [
                'titulo' => 'Atendimento ' . str_replace('_', ' ', $atendimento->status),
                'descricao' => ($atendimento->animal->nome ?? 'Pet') . ': ' . $atendimento->descricao,
                'data' => $atendimento->created_at,
                'icone' => 'stethoscope',
                'cor' => 'bg-brand-light',
                'cor_icone' => 'text-brand',
            ]);

        $animaisRecentes = $animais
            ->take(2)
            ->map(fn (Animal $animal) => [
                'titulo' => 'Novo pet cadastrado',
                'descricao' => $animal->nome . ' foi adicionado(a)',
                'data' => $animal->created_at,
                'icone' => 'paw-print',
                'cor' => 'bg-rose-50',
                'cor_icone' => 'text-rose-400',
            ]);

        $atividades = $vacinasRecentes
            ->concat($atendimentosRecentes)
            ->concat($animaisRecentes)
            ->sortByDesc('data')
            ->take(5)
            ->values();

        return view('dashboard', compact(
            'animais',
            'totalAnimais',
            'atendimentos',
            'totalAtendimentos',
            'atendimentosAbertos',
            'clinicas',
            'totalClinicas',
            'atividades'
        ));
    }
}
