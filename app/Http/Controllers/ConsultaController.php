<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Clinica;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with(['animal', 'clinica'])
            ->where('user_id', Auth::id())
            ->orderBy('data')
            ->orderBy('hora')
            ->get();

        return view('consultas.index', compact('consultas'));
    }

    public function create()
    {
        $animais = Animal::where('id_usuario', Auth::id())->orderBy('nome')->get();
        $clinicas = Clinica::orderBy('nome')->get();

        return view('consultas.create', compact('animais', 'clinicas'));
    }

    public function store(Request $request)
    {
        $consulta = Consulta::create($this->validatedConsulta($request));

        if ($consulta->tipo === 'online') {
            $consulta->update([
                'sala_url' => route('telemedicina.sala', $consulta),
            ]);
        }

        return redirect()
            ->route('consultas.index')
            ->with('success', 'Consulta agendada com sucesso.');
    }

    public function show($id)
    {
        $consulta = $this->ownedConsulta($id);

        return view('consultas.show', compact('consulta'));
    }

    public function destroy($id)
    {
        $consulta = $this->ownedConsulta($id);
        $consulta->delete();

        return redirect()
            ->route('consultas.index')
            ->with('success', 'Consulta removida com sucesso.');
    }

    private function validatedConsulta(Request $request): array
    {
        $data = $request->validate([
            'animal_id' => [
                'required',
                Rule::exists('animais', 'id')->where('id_usuario', Auth::id()),
            ],
            'clinica_id' => ['nullable', 'exists:clinicas,id'],
            'tipo' => ['required', Rule::in(['presencial', 'online'])],
            'veterinario' => ['nullable', 'string', 'max:255'],
            'especialidade' => ['nullable', 'string', 'max:255'],
            'data' => ['required', 'date', 'after_or_equal:today'],
            'hora' => ['nullable', 'date_format:H:i'],
            'valor' => ['nullable', 'numeric', 'min:0'],
            'observacoes' => ['nullable', 'string', 'max:2000'],
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'agendada';

        return $data;
    }

    private function ownedConsulta(int|string $id): Consulta
    {
        return Consulta::with(['animal', 'clinica'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
    }
}
