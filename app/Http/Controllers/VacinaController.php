<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VacinaController extends Controller
{
    public function index()
    {
        $animais = Animal::with(['vacinas' => fn ($query) => $query->latest('data_aplicacao')])
            ->where('id_usuario', Auth::id())
            ->orderBy('nome')
            ->get();

        $vacinas = Vacina::with('animal')
            ->whereHas('animal', fn ($query) => $query->where('id_usuario', Auth::id()))
            ->latest('data_aplicacao')
            ->get();

        return view('vacinas.index', compact('animais', 'vacinas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id' => [
                'required',
                Rule::exists('animais', 'id')->where('id_usuario', Auth::id()),
            ],
            'nome' => ['required', 'string', 'max:255'],
            'data_aplicacao' => ['required', 'date', 'before_or_equal:today'],
            'proxima_dose' => ['nullable', 'date', 'after_or_equal:data_aplicacao'],
        ]);

        Vacina::create($data);

        return redirect()
            ->route('vacinas.index')
            ->with('success', 'Vacina cadastrada com sucesso.');
    }

    public function destroy($id)
    {
        $vacina = Vacina::whereHas('animal', fn ($query) => $query->where('id_usuario', Auth::id()))
            ->findOrFail($id);

        $vacina->delete();

        return redirect()
            ->route('vacinas.index')
            ->with('success', 'Vacina excluida com sucesso.');
    }
}
