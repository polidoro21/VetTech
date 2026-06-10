<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('animal_id')->constrained('animais')->onDelete('cascade');
            $table->foreignId('clinica_id')->nullable()->constrained('clinicas')->nullOnDelete();
            $table->string('tipo')->default('presencial');
            $table->string('veterinario')->nullable();
            $table->string('especialidade')->nullable();
            $table->date('data');
            $table->time('hora')->nullable();
            $table->string('status')->default('agendada');
            $table->decimal('valor', 8, 2)->nullable();
            $table->text('observacoes')->nullable();
            $table->string('sala_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
