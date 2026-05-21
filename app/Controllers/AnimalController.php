<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animais = Animal::all();

        return view('animais.index', compact('animais'));
    }

    public function create()
    {
        return view('animais.create');
    }

    public function store(Request $request)
    {
        Animal::create($request->all());

        return redirect()->route('animais.index');
    }

    public function edit($id)
    {
        $animal = Animal::findOrFail($id);

        return view('animais.edit', compact('animal'));
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        $animal->update($request->all());

        return redirect()->route('animais.index');
    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);

        $animal->delete();

        return redirect()->route('animais.index');
    }
}
