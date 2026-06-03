<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    public function index()
    {
        return view('atendimentos.index');
    }

    public function create()
    {
        return view('atendimentos.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('atendimentos.index');
    }

    public function updateStatus($id)
    {
        return redirect()->route('atendimentos.index');
    }

    public function destroy($id)
    {
        return redirect()->route('atendimentos.index');
    }
}
