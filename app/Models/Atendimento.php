<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'veterinario_id',
        'animal_id',
        'modo',
        'data',
        'descricao',
        'valor',
        'observacoes',
        'status',
        'recusado_por',
        'started_at',
        'finished_at',
        'video_url',
        'descricao_observado',
        'anotacoes',
        'receita_path',
    ];

    protected $casts = [
        'data' => 'date',
        'valor' => 'decimal:2',
        'recusado_por' => 'array',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    // Relacionamento com Animal
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function veterinario()
    {
        return $this->belongsTo(User::class, 'veterinario_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
