<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacina extends Model
{
    protected $fillable = [
        'animal_id',
        'nome',
        'data_aplicacao',
        'proxima_dose'
    ];

    protected $casts = [
        'data_aplicacao' => 'date',
        'proxima_dose' => 'date',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
