<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Animal;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR CONSULTAS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $consultas = Consulta::with('animal')
            ->orderBy('data', 'desc')
            ->get();

        return view('atendimentos.consulta', compact(
            'consultas'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | FORMULÁRIO NOVA CONSULTA
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $animais = Animal::all();

        return view('atendimentos.create', compact(
            'animais'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | SALVAR CONSULTA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'animal_id'   => 'required|exists:animais,id',
            'veterinario' => 'required|string|max:255',
            'data'        => 'required|date',
            'observacoes' => 'nullable|string|max:2000',
        ]);

        Consulta::create([
            'animal_id'   => $request->animal_id,
            'veterinario' => $request->veterinario,
            'data'        => $request->data,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()
            ->route('consultas.index')
            ->with('success', 'Consulta cadastrada com sucesso!');
    }

    /*
    |--------------------------------------------------------------------------
    | EXCLUIR CONSULTA
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);

        $consulta->delete();

        return redirect()
            ->back()
            ->with('success', 'Consulta removida!');
    }
}
