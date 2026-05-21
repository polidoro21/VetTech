<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'animal_id',
        'veterinario',
        'data',
        'observacoes'
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
