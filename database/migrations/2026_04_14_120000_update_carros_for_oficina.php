<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('carros', 'servico')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->text('servico')->nullable()->after('preco');
            });
        }

        if (!Schema::hasColumn('carros', 'data_servico')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->date('data_servico')->nullable()->after('servico');
            });
        }

        DB::table('carros')->whereNull('servico')->update([
            'servico' => 'Servico nao informado',
        ]);

        DB::table('carros')->whereNull('data_servico')->update([
            'data_servico' => DB::raw('date(created_at)'),
        ]);

        if (Schema::hasColumn('carros', 'proprietario')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->dropColumn('proprietario');
            });
        }

        if (Schema::hasColumn('carros', 'renavam')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->dropColumn('renavam');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('carros', 'proprietario')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->string('proprietario')->nullable()->after('placa');
            });
        }

        if (!Schema::hasColumn('carros', 'renavam')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->string('renavam')->nullable()->after('data_servico');
            });
        }

        if (Schema::hasColumn('carros', 'data_servico')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->dropColumn('data_servico');
            });
        }

        if (Schema::hasColumn('carros', 'servico')) {
            Schema::table('carros', function (Blueprint $table) {
                $table->dropColumn('servico');
            });
        }
    }
};
