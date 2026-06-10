<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    use HasFactory;

    protected $table = 'clinicas';

    protected $fillable = [
        'nome',
        'tipo',
        'telefone',
        'email',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'distancia',
        'nota',
        'aberta_agora',
        'horario_abertura',
        'descricao',
        'telemedicina',
    ];

    protected $casts = [
        'aberta_agora' => 'boolean',
        'telemedicina' => 'boolean',
        'distancia' => 'decimal:2',
        'nota' => 'decimal:1',
    ];

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function getEnderecoCompletoAttribute(): string
    {
        return collect([
            trim(($this->logradouro ?? '') . ', ' . ($this->numero ?? '')),
            $this->bairro,
            trim(($this->cidade ?? '') . ' - ' . ($this->uf ?? '')),
        ])->filter()->implode(' - ');
    }
}
