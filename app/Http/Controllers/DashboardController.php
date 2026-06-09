<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Animal;
use App\Models\Atendimento;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id() ?? 0;

        // Animais do usuário
        $animais = Animal::where('id_usuario', $userId)
            ->latest()
            ->take(3)
            ->get();

        $totalAnimais = Animal::where('id_usuario', $userId)->count();

        // Dados temporários (tabelas ainda não existem)
        $consultas = collect();
        $totalConsultas = 0;

        $clinicas = collect();
        $totalClinicas = 0;

        $vacinasRecentes = collect();

        // Atendimentos recentes
        $atendimentosRecentes = Atendimento::latest()
            ->take(3)
            ->get()
            ->map(fn($a) => [
                'tipo'      => 'atendimento',
                'titulo'    => 'Atendimento realizado',
                'descricao' => $a->descricao ?? 'Atendimento',
                'data'      => $a->created_at,
                'icone'     => 'stethoscope',
                'cor'       => 'brand-light',
                'cor_icone' => 'text-brand',
            ]);

        // Animais recentes
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
