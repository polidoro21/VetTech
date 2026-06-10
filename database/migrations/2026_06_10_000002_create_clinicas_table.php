<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinicas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('tipo')->default('Clinica veterinaria');
            $table->string('telefone', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('cep', 8)->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf', 2)->nullable();
            $table->decimal('distancia', 6, 2)->nullable();
            $table->decimal('nota', 2, 1)->nullable();
            $table->boolean('aberta_agora')->default(false);
            $table->string('horario_abertura')->nullable();
            $table->text('descricao')->nullable();
            $table->boolean('telemedicina')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinicas');
    }
};
