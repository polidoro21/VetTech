<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        return view('animais.index');
    }

    public function create()
    {
        return view('animais.create');
    }

    public function edit($id)
    {
        return view('animais.edit');
    }

    public function store(Request $request)
    {
        return redirect()->route('animais.index');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('animais.index');
    }

    public function destroy($id)
    {
        return redirect()->route('animais.index');
    }
}
