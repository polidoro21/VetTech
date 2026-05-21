<?php

namespace App\Http\Controllers;

use App\Models\Vacina;
use App\Models\Animal;
use Illuminate\Http\Request;

class VacinaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTAR VACINAS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $animais = Animal::all();

        $vacinas = Vacina::with('animal')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('animais.carteira-de-vacina', compact(
            'animais',
            'vacinas'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | SALVAR VACINA
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'animal_id'      => 'required|exists:animais,id',
            'nome'           => 'required|string|max:255',
            'data_aplicacao' => 'required|date',
            'proxima_dose'   => 'nullable|date',
        ]);

        Vacina::create([
            'animal_id'      => $request->animal_id,
            'nome'           => $request->nome,
            'data_aplicacao' => $request->data_aplicacao,
            'proxima_dose'   => $request->proxima_dose,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Vacina cadastrada com sucesso!');
    }

    /*
    |--------------------------------------------------------------------------
    | EXCLUIR VACINA
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $vacina = Vacina::findOrFail($id);

        $vacina->delete();

        return redirect()
            ->back()
            ->with('success', 'Vacina removida com sucesso!');
    }
}
