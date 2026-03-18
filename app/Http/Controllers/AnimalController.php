<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $pets = Animal::latest()->get(); // ordena do mais recente

        return view('animais.index', compact('pets'));
    }

    public function create()
    {
        return view('animais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'especie' => 'required',
            'raca' => 'required',
            'idade' => 'required|integer',
            'peso' => 'required|numeric'
        ]);

        // MAIS SEGURO que $request->all()
        Animal::create([
            'nome' => $request->nome,
            'especie' => $request->especie,
            'raca' => $request->raca,
            'idade' => $request->idade,
            'peso' => $request->peso
        ]);

        return redirect()->route('animais.index')
            ->with('success', 'Pet cadastrado com sucesso!');
    }
}
