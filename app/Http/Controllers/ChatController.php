<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::where('user_id', Auth::id())
            ->oldest()
            ->get();

        return view('chat.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mensagem' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'usuario' => Auth::user()->name,
            'mensagem' => $data['mensagem'],
        ]);

        return redirect()->route('chat');
    }
}
