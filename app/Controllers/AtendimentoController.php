<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Animal;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    // Mostrar formulário + lista de atendimentos
    public function create()
    {
        $animais = Animal::all(); // pega todos os animais
        $atendimentos = Atendimento::with('animal')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('atendimentos.create', compact('animais', 'atendimentos'));
    }

    public function updateStatus(Request $request, $id)
{
    $atendimento = Atendimento::findOrFail($id);
    $atendimento->status = $request->status;
    $atendimento->save();

    return redirect()->back();
}

    // Salvar atendimento
    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animais,id',
            'data' => 'required|date',
            'descricao' => 'required|string',
            'valor' => 'required|numeric',
            'observacoes' => 'nullable|string',
        ]);

        Atendimento::create($request->all());
        return redirect()->route('atendimentos.create')
            ->with('success', 'Atendimento cadastrado com sucesso!');
    }
}
