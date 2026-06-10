<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Models\Animal;
use App\Models\Atendimento;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id() ?? 0;

        // ── Animais ────────────────────────────────────────────────
        $animais      = Animal::where('id_usuario', $userId)->latest()->take(3)->get();
        $totalAnimais = Animal::where('id_usuario', $userId)->count();

        // ── Consultas ──────────────────────────────────────────────
        // Carrega do model real quando a tabela existir; coleta vazia como fallback.
        $consultas      = collect();
        $totalConsultas = 0;

        if (Schema::hasTable('consultas')) {
            $consultas = \App\Models\Consulta::where('id_usuario', $userId)
                ->where('data', '>=', now())
                ->orderBy('data')
                ->take(5)
                ->get();

            $totalConsultas = \App\Models\Consulta::where('id_usuario', $userId)->count();
        }

        // ── Clínicas ───────────────────────────────────────────────
        $clinicas      = collect();
        $totalClinicas = 0;

        if (Schema::hasTable('clinicas')) {
            $clinicas      = \App\Models\Clinica::orderBy('distancia')->take(4)->get();
            $totalClinicas = \App\Models\Clinica::count();
        }

        // ── Vacinas recentes ───────────────────────────────────────
        $vacinasRecentes = collect();

        if (Schema::hasTable('vacinas')) {
            $vacinasRecentes = \App\Models\Vacina::whereHas('animal', fn($q) => $q->where('id_usuario', $userId))
                ->with('animal')
                ->latest()
                ->take(3)
                ->get()
                ->map(fn($v) => [
                    'tipo'      => 'vacina',
                    'titulo'    => 'Vacina adicionada',
                    'descricao' => ($v->nome ?? 'Vacina') . ' para ' . ($v->animal->nome ?? ''),
                    'data'      => $v->created_at,
                    'icone'     => 'syringe',
                    'cor'       => 'bg-accent-light',
                    'cor_icone' => 'text-accent',
                ]);
        }

        // ── Atendimentos recentes ──────────────────────────────────
        $atendimentosRecentes = Atendimento::latest()
            ->take(3)
            ->get()
            ->map(fn($a) => [
                'tipo'      => 'atendimento',
                'titulo'    => 'Atendimento realizado',
                'descricao' => $a->descricao ?? 'Atendimento',
                'data'      => $a->created_at,
                'icone'     => 'stethoscope',
                'cor'       => 'bg-brand-light',
                'cor_icone' => 'text-brand',
            ]);

        // ── Animais recentes ───────────────────────────────────────
        $animaisRecentes = Animal::where('id_usuario', $userId)
            ->latest()
            ->take(2)
            ->get()
            ->map(fn($a) => [
                'tipo'      => 'pet',
                'titulo'    => 'Novo pet cadastrado',
                'descricao' => $a->nome . ' foi adicionado(a)',
                'data'      => $a->created_at,
                'icone'     => 'paw-print',
                'cor'       => 'bg-pink-50',
                'cor_icone' => 'text-pink-400',
            ]);

        // ── Atividades mescladas e ordenadas ───────────────────────
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
