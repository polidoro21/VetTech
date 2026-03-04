<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animais';

    protected $fillable = [
        'nome',
        'especie',
        'raca',
        'data_nascimento',
        'cor',
        'id_usuario',
        'porte'
    ];

    // Relacionamento com atendimentos
    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function getIdadeAttribute()
    {
        return Carbon::parse($this->data_nascimento)->age;
    }
}
