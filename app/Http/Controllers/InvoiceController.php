<?php

namespace App\Http\Controllers;

use App\Models\Carros;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create()
    {
        $servicos = Carros::orderBy('data_servico', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('invoices.create', compact('servicos'));
    }

    public function createBudget()
    {
        $servicos = Carros::orderBy('data_servico', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('budgets.create', compact('servicos'));
    }

    public function generate(Request $request)
    {
        $dados = $request->validate([
            'servico_id' => 'nullable|integer|exists:carros,id',
            'cliente_nome' => 'required|string|max:255',
            'cliente_documento' => 'nullable|string|max:255',
            'cliente_telefone' => 'nullable|string|max:255',
            'forma_pagamento' => 'required|string|max:255',
            'observacoes' => 'nullable|string|max:1000',
        ]);

        $servico = null;

        if (!empty($dados['servico_id'])) {
            $servico = Carros::findOrFail($dados['servico_id']);
        }

        $fatura = [
            'numero' => 'FAT-' . now()->format('YmdHis'),
            'emitida_em' => now()->format('d/m/Y H:i'),
            'empresa' => [
                'nome' => 'Ary Auto Center',
                'documento' => '12.345.678/0001-90',
                'telefone' => '(11) 99999-9999',
                'endereco' => 'Rua das Oficinas, 123 - Centro',
            ],
            'cliente' => [
                'nome' => $dados['cliente_nome'],
                'documento' => $dados['cliente_documento'] ?: '-',
                'telefone' => $dados['cliente_telefone'] ?: '-',
            ],
            'servico' => [
                'id' => $servico?->id,
                'placa' => $servico?->placa ?? '-',
                'carro' => $servico?->carro ?? '-',
                'data' => $servico?->data_servico?->format('d/m/Y') ?? '-',
                'descricao' => $servico?->servico ?? 'Servico informado manualmente na oficina.',
                'valor' => $servico ? (float) $servico->preco : 0.0,
                'garantia' => $servico?->garantia_fim?->format('d/m/Y') ?? '-',
            ],
            'forma_pagamento' => $dados['forma_pagamento'],
            'observacoes' => $dados['observacoes'] ?: 'Documento gerado para conferencia do atendimento.',
        ];

        $pdf = Pdf::loadView('invoice', compact('fatura'))->setPaper('a4');

        return $pdf->stream($fatura['numero'] . '.pdf');
    }

    public function generateBudget(Request $request)
    {
        $dados = $request->validate([
            'servico_id' => 'nullable|integer|exists:carros,id',
            'cliente_nome' => 'required|string|max:255',
            'cliente_documento' => 'nullable|string|max:255',
            'cliente_telefone' => 'nullable|string|max:255',
            'placa' => 'required|string|max:255',
            'carro' => 'required|string|max:255',
            'data_servico' => 'nullable|date',
            'descricao_servico' => 'required|string|max:1000',
            'valor_estimado' => 'required|numeric',
            'validade' => 'required|string|max:255',
            'observacoes' => 'nullable|string|max:1000',
        ]);

        $orcamento = [
            'numero' => 'ORC-' . now()->format('YmdHis'),
            'emitido_em' => now()->format('d/m/Y H:i'),
            'empresa' => [
                'nome' => 'Ary Auto Center',
                'documento' => '12.345.678/0001-90',
                'telefone' => '(11) 99999-9999',
                'endereco' => 'Rua das Oficinas, 123 - Centro',
            ],
            'cliente' => [
                'nome' => $dados['cliente_nome'],
                'documento' => $dados['cliente_documento'] ?: '-',
                'telefone' => $dados['cliente_telefone'] ?: '-',
            ],
            'servico' => [
                'id' => $dados['servico_id'] ?: null,
                'placa' => $dados['placa'],
                'carro' => $dados['carro'],
                'data' => !empty($dados['data_servico']) ? \Carbon\Carbon::parse($dados['data_servico'])->format('d/m/Y') : '-',
                'descricao' => $dados['descricao_servico'],
                'valor' => (float) $dados['valor_estimado'],
            ],
            'validade' => $dados['validade'],
            'observacoes' => $dados['observacoes'] ?: 'Orcamento sujeito a aprovacao do cliente e disponibilidade de agenda.',
        ];

        $pdf = Pdf::loadView('budget', compact('orcamento'))->setPaper('a4');

        return $pdf->stream($orcamento['numero'] . '.pdf');
    }
}
