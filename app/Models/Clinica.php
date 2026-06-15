<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinica extends Model
{
    use HasFactory;

    protected $table = 'clinicas';

    protected $fillable = [
        'user_id',
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
        'status',
        'pending_changes',
        'approved_at',
        'rejection_reason',
    ];

    protected $casts = [
        'aberta_agora' => 'boolean',
        'telemedicina' => 'boolean',
        'distancia' => 'decimal:2',
        'nota' => 'decimal:1',
        'pending_changes' => 'array',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
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
