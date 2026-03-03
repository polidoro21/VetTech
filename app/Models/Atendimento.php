<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id', 'data', 'descricao', 'valor', 'observacoes'
    ];

    // Relacionamento com Animal
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
