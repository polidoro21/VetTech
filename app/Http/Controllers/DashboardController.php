<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Animal;
use App\Models\Consulta;
use App\Models\Clinica;
use App\Models\Vacina;
use App\Models\Atendimento;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // ── Animais do usuário logado ──────────────────────────
        $animais      = Animal::where('user_id', $userId)->latest()->take(3)->get();
        $totalAnimais = Animal::where('user_id', $userId)->count();

        // ── Próximas consultas (adapte o campo de data ao seu model) ──
        $consultas = Consulta::whereHas('animal', fn($q) => $q->where('user_id', $userId))
            ->where('data', '>=', now()->toDateString())
            ->orderBy('data')
            ->take(5)
            ->get();

        $totalConsultas = Consulta::whereHas('animal', fn($q) => $q->where('user_id', $userId))
            ->count();

        // ── Clínicas próximas (dados públicos) ────────────────
        $clinicas      = Clinica::take(4)->get();
        $totalClinicas = Clinica::count();

        // ── Atividades recentes ────────────────────────────────
        // Combina vacinas, atendimentos e animais cadastrados recentemente
        $vacinasRecentes = Vacina::whereHas('animal', fn($q) => $q->where('user_id', $userId))
            ->latest()->take(3)->get()
            ->map(fn($v) => [
                'tipo'      => 'vacina',
                'titulo'    => 'Vacina adicionada',
                'descricao' => $v->nome . ' para ' . $v->animal->nome,
                'data'      => $v->created_at,
                'icone'     => 'syringe',
                'cor'       => 'accent-light',
                'cor_icone' => 'text-accent',
            ]);

        $atendimentosRecentes = Atendimento::whereHas('animal', fn($q) => $q->where('user_id', $userId))
            ->latest()->take(3)->get()
            ->map(fn($a) => [
                'tipo'      => 'atendimento',
                'titulo'    => 'Consulta realizada',
                'descricao' => ($a->descricao ?? 'Atendimento') . ' — ' . $a->animal->nome,
                'data'      => $a->created_at,
                'icone'     => 'stethoscope',
                'cor'       => 'brand-light',
                'cor_icone' => 'text-brand',
            ]);

        $animaisRecentes = Animal::where('user_id', $userId)->latest()->take(2)->get()
            ->map(fn($a) => [
                'tipo'      => 'pet',
                'titulo'    => 'Novo pet cadastrado',
                'descricao' => $a->nome . ' foi adicionado(a)',
                'data'      => $a->created_at,
                'icone'     => 'paw-print',
                'cor'       => 'bg-pink-50',
                'cor_icone' => 'text-pink-400',
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
            'atividades',
        ));
    }
}
