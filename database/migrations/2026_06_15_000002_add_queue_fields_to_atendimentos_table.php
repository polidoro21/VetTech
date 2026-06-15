<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('atendimentos', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('veterinario_id')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            $table->string('modo')->default('chat')->after('animal_id');
            $table->json('recusado_por')->nullable()->after('status');
            $table->timestamp('started_at')->nullable()->after('recusado_por');
            $table->timestamp('finished_at')->nullable()->after('started_at');
            $table->string('video_url')->nullable()->after('finished_at');
            $table->text('descricao_observado')->nullable()->after('video_url');
            $table->text('anotacoes')->nullable()->after('descricao_observado');
            $table->string('receita_path')->nullable()->after('anotacoes');
        });
    }

    public function down(): void
    {
        Schema::table('atendimentos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('veterinario_id');
            $table->dropColumn([
                'modo',
                'recusado_por',
                'started_at',
                'finished_at',
                'video_url',
                'descricao_observado',
                'anotacoes',
                'receita_path',
            ]);
        });
    }
};
