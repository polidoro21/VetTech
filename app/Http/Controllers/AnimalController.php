<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function create()
    {
        return view('animais.create');
    }

    public function index()
    {
        $pets = Animal::all(); // Pega todos os animais

        return view('animais.index', compact('pets'));
    }

    public function store(Request $request)
    {
        Animal::create($request->all());

        return redirect()->route('animais.index')
            ->with('success', 'Animal cadastrado com sucesso!');
    }
}
