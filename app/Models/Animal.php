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

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTO USUÁRIO
    |--------------------------------------------------------------------------
    */

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTO ATENDIMENTOS
    |--------------------------------------------------------------------------
    */

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class, 'animal_id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTO VACINAS
    |--------------------------------------------------------------------------
    */

    public function vacinas()
    {
        return $this->hasMany(Vacina::class, 'animal_id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTO CONSULTAS
    |--------------------------------------------------------------------------
    */

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'animal_id');
    }

    /*
    |--------------------------------------------------------------------------
    | IDADE AUTOMÁTICA
    |--------------------------------------------------------------------------
    */

    public function getIdadeAttribute()
    {
        return Carbon::parse($this->data_nascimento)->age;
    }
}
