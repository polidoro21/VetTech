<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{
    public function index()
    {
        $pets = Animal::where('id_usuario', Auth::id())
            ->latest()
            ->get();

        return view('animais.index', compact('pets'));
    }

    public function create()
    {
        return view('animais.create');
    }

    public function show($id)
    {
        $animal = $this->ownedAnimal($id);

        return view('animais.show', compact('animal'));
    }

    public function store(Request $request)
    {
        $data = $this->validateAnimal($request);
        $data['id_usuario'] = Auth::id();

        Animal::create($data);

        return redirect()
            ->route('animais.index')
            ->with('success', 'Pet cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $animal = $this->ownedAnimal($id);

        return view('animais.edit', compact('animal'));
    }

    public function update(Request $request, $id)
    {
        $animal = $this->ownedAnimal($id);
        $animal->update($this->validateAnimal($request));

        return redirect()
            ->route('animais.index')
            ->with('success', 'Pet atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $animal = $this->ownedAnimal($id);
        $animal->delete();

        return redirect()
            ->route('animais.index')
            ->with('success', 'Pet excluido com sucesso.');
    }

    private function validateAnimal(Request $request): array
    {
        return $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'especie' => ['required', 'string', 'max:120'],
            'raca' => ['nullable', 'string', 'max:120'],
            'data_nascimento' => ['nullable', 'date', 'before_or_equal:today'],
            'cor' => ['nullable', 'string', 'max:120'],
            'porte' => ['required', 'in:pequeno,medio,grande'],
        ]);
    }

    private function ownedAnimal(int|string $id): Animal
    {
        return Animal::where('id_usuario', Auth::id())->findOrFail($id);
    }
}
