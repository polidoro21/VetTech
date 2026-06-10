<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Atendimento;
use App\Models\Clinica;
use App\Models\Consulta;
use App\Models\Vacina;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $animais = Animal::where('id_usuario', $userId)
            ->latest()
            ->take(4)
            ->get();

        $totalAnimais = Animal::where('id_usuario', $userId)->count();

        $consultas = Consulta::with(['animal', 'clinica'])
            ->where('user_id', $userId)
            ->where('data', '>=', now()->toDateString())
            ->orderBy('data')
            ->orderBy('hora')
            ->take(5)
            ->get();

        $totalConsultas = Consulta::where('user_id', $userId)->count();

        $clinicas = Clinica::orderByRaw('distancia is null')
            ->orderBy('distancia')
            ->orderBy('nome')
            ->take(4)
            ->get();

        $totalClinicas = Clinica::count();

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
            ->whereHas('animal', fn ($query) => $query->where('id_usuario', $userId))
            ->latest()
            ->take(3)
            ->get()
            ->map(fn (Atendimento $atendimento) => [
                'titulo' => 'Atendimento registrado',
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
            'consultas',
            'totalConsultas',
            'clinicas',
            'totalClinicas',
            'atividades'
        ));
    }
}
