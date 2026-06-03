<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VacinaController extends Controller
{
    public function index()
    {
        return view('vacinas.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('vacinas.index');
    }

    public function destroy($id)
    {
        return redirect()->route('vacinas.index');
    }
}
