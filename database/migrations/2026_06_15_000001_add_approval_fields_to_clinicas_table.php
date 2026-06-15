<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('clinicas', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->nullOnDelete();
            $table->string('status')->default('approved')->after('telemedicina');
            $table->json('pending_changes')->nullable()->after('status');
            $table->timestamp('approved_at')->nullable()->after('pending_changes');
            $table->text('rejection_reason')->nullable()->after('approved_at');
        });

        DB::table('clinicas')
            ->where('status', 'approved')
            ->whereNull('approved_at')
            ->update(['approved_at' => now()]);
    }

    public function down(): void
    {
        Schema::table('clinicas', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn([
                'status',
                'pending_changes',
                'approved_at',
                'rejection_reason',
            ]);
        });
    }
};
