<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'asc')->get();
        return view('chat.index', compact('messages'));
    }

    public function store(Request $request)
    {
        Message::create([
            'usuario' => session('usuario')['name'] ?? 'Usuário',
            'mensagem' => $request->mensagem
        ]);

        return redirect()->back();
    }
}
