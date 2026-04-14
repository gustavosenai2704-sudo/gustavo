<?php

namespace App\Http\Controllers;

use App\Models\Carros;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarroController extends Controller
{
    public function carros()
    {
        return redirect()->route('carros.salvar.form');
    }

    public function salvarForm()
    {
        return view('salvarcarro');
    }

    public function alterarForm()
    {
        $carros = Carros::orderByDesc('data_servico')->orderByDesc('id')->get();

        return view('alterarcarro', compact('carros'));
    }

    public function deletarForm()
    {
        $carros = Carros::orderByDesc('data_servico')->orderByDesc('id')->get();

        return view('deletarcarro', compact('carros'));
    }

    public function listar(Request $request)
    {
        $ordem = $request->get('ordem', 'recentes');
        $direcao = $ordem === 'antigos' ? 'asc' : 'desc';

        $carros = Carros::orderBy('data_servico', $direcao)
            ->orderBy('id', $direcao)
            ->get();

        return view('listacarros', compact('carros', 'ordem'));
    }

    public function salvar(Request $request)
    {
        $dados = $request->validate([
            'placa' => 'required|string|max:255',
            'carro' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'servico' => 'required|string|max:1000',
            'data_servico' => 'required|date',
        ]);

        $carro = Carros::create($dados);

        return redirect()
            ->route('carros.salvar.form')
            ->with('success', 'Servico cadastrado com sucesso.')
            ->with('servico_novo_id', $carro->id)
            ->with('servico_novo_placa', $carro->placa);
    }

    public function alterar(Request $request)
    {
        $dados = $request->validate([
            'id' => 'required|integer|exists:carros,id',
            'placa' => 'required|string|max:255',
            'carro' => 'required|string|max:255',
            'preco' => 'required|numeric',
            'servico' => 'required|string|max:1000',
            'data_servico' => 'required|date',
        ]);

        $carro = Carros::findOrFail($dados['id']);
        $carro->update([
            'placa' => $dados['placa'],
            'carro' => $dados['carro'],
            'preco' => $dados['preco'],
            'servico' => $dados['servico'],
            'data_servico' => $dados['data_servico'],
        ]);

        return redirect()
            ->route('carros.alterar.form')
            ->with('success', 'Servico alterado com sucesso.');
    }

    public function deletar(Request $request)
    {
        $dados = $request->validate([
            'id' => 'required|integer|exists:carros,id',
        ]);

        $carro = Carros::findOrFail($dados['id']);
        $carro->delete();

        return redirect()
            ->route('carros.deletar.form')
            ->with('success', 'Servico deletado com sucesso.');
    }

    public function buscarPorPlaca(Request $request)
    {
        $dados = $request->validate([
            'placa' => 'required|string|max:255',
        ]);

        $carro = Carros::where('placa', $dados['placa'])->first();

        if (!$carro) {
            return response()->json([
                'message' => 'Servico nao encontrado para a placa informada.',
            ], 404);
        }

        return response()->json($carro);
    }

    public function salvarDadosClienteNfse(Request $request, int $id)
    {
        $carro = Carros::findOrFail($id);

        $dados = $request->validate([
            'nome_cliente' => 'required|string|max:255',
            'cpf_cliente' => 'required|string|max:30',
            'endereco_cliente' => 'required|string|max:255',
        ]);

        $carro->update($dados);

        return redirect()->route('emitir.nfse', $carro->id);
    }

    public function emitirNfse(int $id)
    {
        $carro = Carros::findOrFail($id);

        if (blank($carro->nome_cliente) || blank($carro->cpf_cliente)) {
            return redirect()
                ->back()
                ->with('nfse_modal', [
                    'carro_id' => $carro->id,
                    'placa' => $carro->placa,
                    'carro' => $carro->carro,
                    'nome_cliente' => $carro->nome_cliente,
                    'cpf_cliente' => $carro->cpf_cliente,
                    'endereco_cliente' => $carro->endereco_cliente,
                ])
                ->withErrors([
                    'nfse_cliente' => 'Preencha nome e CPF/CNPJ do cliente antes de emitir a NFS-e.',
                ]);
        }

        $carro = DB::transaction(function () use ($carro) {
            $carro->refresh();

            if (blank($carro->numero_nf)) {
                $carro->numero_nf = $this->gerarNumeroNfse();
            }

            if (blank($carro->codigo_verificacao)) {
                $carro->codigo_verificacao = $this->gerarCodigoVerificacao();
            }

            if (blank($carro->data_emissao)) {
                $carro->data_emissao = now();
            }

            $carro->save();

            return $carro->fresh();
        });

        $aliquotaIss = 5.00;
        $baseCalculo = (float) $carro->preco;
        $valorIss = round($baseCalculo * ($aliquotaIss / 100), 2);
        $valorIssRetido = 0.00;
        $desconto = 0.00;
        $valorLiquido = $baseCalculo - $desconto;

        $nfse = [
            'numero' => $carro->numero_nf,
            'codigo_verificacao' => $carro->codigo_verificacao,
            'data_emissao' => $carro->data_emissao,
            'prestador' => [
                'nome' => 'Ary Auto Center',
                'cnpj' => '00.000.000/0001-00',
                'inscricao_municipal' => '123.456-7',
                'endereco' => 'Rua Exemplo, 123 - Centro - Tatui/SP - CEP: 18.270-000',
            ],
            'tomador' => [
                'nome' => $carro->nome_cliente,
                'documento' => $carro->cpf_cliente,
                'endereco' => $carro->endereco_cliente ?: '-',
            ],
            'servico' => [
                'descricao' => 'Alinhamento e Balanceamento',
                'codigo' => '14.05',
                'codigo_descricao' => 'Manutencao e Reparacao Veicular',
                'descricao_detalhada' => $carro->servico,
                'placa' => $carro->placa,
                'veiculo' => $carro->carro,
                'data' => $carro->data_servico,
            ],
            'tributacao' => [
                'base_calculo' => $baseCalculo,
                'aliquota_iss' => $aliquotaIss,
                'valor_iss' => $valorIss,
                'valor_iss_retido' => $valorIssRetido,
            ],
            'totais' => [
                'valor_servico' => $baseCalculo,
                'desconto' => $desconto,
                'valor_liquido' => $valorLiquido,
            ],
        ];

        $pdf = Pdf::loadView('nota-fiscal-tatui', compact('nfse'))->setPaper('a4');

        return $pdf->stream($carro->numero_nf . '.pdf');
    }

    private function gerarNumeroNfse(): string
    {
        $prefixo = 'NF-' . now()->format('Y-m') . '-';
        $sequencial = Carros::where('numero_nf', 'like', $prefixo . '%')->count() + 1;

        return $prefixo . str_pad((string) $sequencial, 4, '0', STR_PAD_LEFT);
    }

    private function gerarCodigoVerificacao(): string
    {
        return strtoupper(Str::random(10));
    }
}
