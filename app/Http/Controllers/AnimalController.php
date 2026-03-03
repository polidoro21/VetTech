<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function create()
    {
        return view('cadastro');
    }

    public function store(Request $request)
    {
        Animal::create($request->all());

        return redirect('/cadastro')
            ->with('success', 'Animal cadastrado com sucesso!');
    }
}
