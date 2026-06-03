<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClinicaController extends Controller
{
    public function index()
    {
        return view('clinicas.index');
    }

    public function buscar(Request $request)
    {
        return view('clinicas.buscar');
    }
}
