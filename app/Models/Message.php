<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['atendimento_id', 'user_id', 'usuario', 'mensagem'];

    public function atendimento()
    {
        return $this->belongsTo(Atendimento::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
