<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carros', function (Blueprint $table) {
            if (!Schema::hasColumn('carros', 'numero_nf')) {
                $table->string('numero_nf')->nullable()->after('data_servico');
            }

            if (!Schema::hasColumn('carros', 'cpf_cliente')) {
                $table->string('cpf_cliente')->nullable()->after('numero_nf');
            }

            if (!Schema::hasColumn('carros', 'nome_cliente')) {
                $table->string('nome_cliente')->nullable()->after('cpf_cliente');
            }

            if (!Schema::hasColumn('carros', 'endereco_cliente')) {
                $table->string('endereco_cliente')->nullable()->after('nome_cliente');
            }

            if (!Schema::hasColumn('carros', 'codigo_verificacao')) {
                $table->string('codigo_verificacao')->nullable()->after('endereco_cliente');
            }

            if (!Schema::hasColumn('carros', 'data_emissao')) {
                $table->timestamp('data_emissao')->nullable()->after('codigo_verificacao');
            }
        });
    }

    public function down(): void
    {
        Schema::table('carros', function (Blueprint $table) {
            $colunas = [];

            foreach (['numero_nf', 'cpf_cliente', 'nome_cliente', 'endereco_cliente', 'codigo_verificacao', 'data_emissao'] as $coluna) {
                if (Schema::hasColumn('carros', $coluna)) {
                    $colunas[] = $coluna;
                }
            }

            if ($colunas !== []) {
                $table->dropColumn($colunas);
            }
        });
    }
};
