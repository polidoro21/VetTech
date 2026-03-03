<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'especie', 'raca', 'idade', 'nome_dono'];

    // Relacionamento com atendimentos
    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class);
    }
}
