<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index()
    {
        return view('consultas.index');
    }

    public function create()
    {
        return view('consultas.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('consultas.index');
    }
}
