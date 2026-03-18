<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table = 'animals'; // importante!

    protected $fillable = [
        'nome',
        'especie',
        'raca',
        'idade',
        'peso'
    ];
}