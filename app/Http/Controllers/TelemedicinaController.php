<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Clinica;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TelemedicinaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with(['animal', 'clinica'])
            ->where('user_id', Auth::id())
            ->where('tipo', 'online')
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        $animais = Animal::where('id_usuario', Auth::id())->orderBy('nome')->get();
        $clinicas = Clinica::where('telemedicina', true)->orderBy('nome')->get();

        return view('telemedicina.index', compact('consultas', 'animais', 'clinicas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'animal_id' => [
                'required',
                Rule::exists('animais', 'id')->where('id_usuario', Auth::id()),
            ],
            'clinica_id' => ['nullable', 'exists:clinicas,id'],
            'veterinario' => ['nullable', 'string', 'max:255'],
            'especialidade' => ['nullable', 'string', 'max:255'],
            'data' => ['required', 'date', 'after_or_equal:today'],
            'hora' => ['nullable', 'date_format:H:i'],
            'observacoes' => ['nullable', 'string', 'max:2000'],
        ]);

        $consulta = Consulta::create($data + [
            'user_id' => Auth::id(),
            'tipo' => 'online',
            'status' => 'agendada',
        ]);

        $consulta->update([
            'sala_url' => route('telemedicina.sala', $consulta),
        ]);

        return redirect()
            ->route('telemedicina.index')
            ->with('success', 'Consulta online agendada com sucesso.');
    }

    public function sala($id)
    {
        $consulta = Consulta::with(['animal', 'clinica'])
            ->where('user_id', Auth::id())
            ->where('tipo', 'online')
            ->findOrFail($id);

        return view('telemedicina.sala', compact('consulta'));
    }
}
