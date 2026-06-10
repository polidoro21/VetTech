<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('tipo')->default('tutor');
            $table->string('phone', 20)->nullable();
            $table->string('cpf', 11)->nullable()->unique();
            $table->string('crmv', 20)->nullable();
            $table->string('cnpj', 14)->nullable()->unique();
            $table->string('cep', 8)->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero', 20)->nullable();
            $table->string('bairro')->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf', 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'tipo',
                'phone',
                'cpf',
                'crmv',
                'cnpj',
                'cep',
                'logradouro',
                'numero',
                'bairro',
                'cidade',
                'uf',
            ]);
        });
    }
};
