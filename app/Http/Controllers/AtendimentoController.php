<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Atendimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AtendimentoController extends Controller
{
    public function index()
    {
        $atendimentos = Atendimento::with('animal')
            ->whereHas('animal', fn ($query) => $query->where('id_usuario', Auth::id()))
            ->latest('data')
            ->get();

        return view('atendimentos.index', compact('atendimentos'));
    }

    public function create()
    {
        $animais = Animal::where('id_usuario', Auth::id())->orderBy('nome')->get();

        return view('atendimentos.create', compact('animais'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id' => [
                'required',
                Rule::exists('animais', 'id')->where('id_usuario', Auth::id()),
            ],
            'data' => ['required', 'date'],
            'descricao' => ['required', 'string', 'max:1000'],
            'valor' => ['required', 'numeric', 'min:0'],
            'observacoes' => ['nullable', 'string', 'max:2000'],
            'status' => ['nullable', Rule::in(['nao_atendido', 'atendido'])],
        ]);

        $data['status'] = $data['status'] ?? 'nao_atendido';

        Atendimento::create($data);

        return redirect()
            ->route('atendimentos.index')
            ->with('success', 'Atendimento cadastrado com sucesso.');
    }

    public function updateStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['nao_atendido', 'atendido'])],
        ]);

        $atendimento = $this->ownedAtendimento($id);
        $atendimento->update($data);

        return redirect()
            ->route('atendimentos.index')
            ->with('success', 'Status atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $atendimento = $this->ownedAtendimento($id);
        $atendimento->delete();

        return redirect()
            ->route('atendimentos.index')
            ->with('success', 'Atendimento excluido com sucesso.');
    }

    private function ownedAtendimento(int|string $id): Atendimento
    {
        return Atendimento::whereHas('animal', fn ($query) => $query->where('id_usuario', Auth::id()))
            ->findOrFail($id);
    }
}
