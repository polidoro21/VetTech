<?php

namespace App\Http\Controllers;

use App\Models\Clinica;
use Illuminate\Http\Request;

class ClinicaController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->string('busca')->toString();

        $clinicas = Clinica::query()
            ->approved()
            ->when($busca !== '', function ($query) use ($busca) {
                $query->where(function ($inner) use ($busca) {
                    $inner->where('nome', 'like', "%{$busca}%")
                        ->orWhere('cidade', 'like', "%{$busca}%")
                        ->orWhere('bairro', 'like', "%{$busca}%")
                        ->orWhere('tipo', 'like', "%{$busca}%");
                });
            })
            ->orderByRaw('distancia is null')
            ->orderBy('distancia')
            ->orderBy('nome')
            ->get();

        return view('clinicas.index', compact('clinicas', 'busca'));
    }

    public function buscar(Request $request)
    {
        return $this->index($request);
    }

    public function show($id)
    {
        $clinica = Clinica::approved()->findOrFail($id);

        return view('clinicas.show', compact('clinica'));
    }
}
