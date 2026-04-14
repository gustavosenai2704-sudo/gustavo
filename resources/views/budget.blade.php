<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Orcamento {{ $orcamento['numero'] }} - Ary Auto Center</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Courier New', 'Arial', monospace;
            background: #e8e8e8;
            padding: 20px;
            font-size: 11px;
        }

        .nf-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 1px solid #000;
            padding: 15px;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
        }

        /* BORDAS PADRAO NOTA FISCAL */
        .borda {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .borda-bottom {
            border-bottom: 1px solid #000;
        }

        .borda-right {
            border-right: 1px solid #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .small {
            font-size: 9px;
        }

        /* CABECALHO PREFEITURA */
        .header-prefeitura {
            text-align: center;
            margin-bottom: 15px;
        }

        .header-prefeitura h1 {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-prefeitura h2 {
            font-size: 11px;
            font-weight: normal;
        }

        .header-prefeitura p {
            font-size: 9px;
        }

        .brasao {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .linha {
            border-top: 1px solid #000;
            margin: 8px 0;
        }

        /* INFORMACOES */
        .info-title {
            background: #f0f0f0;
            font-weight: bold;
        }

        .assinatura {
            margin-top: 20px;
            text-align: center;
            border-top: 1px dashed #000;
            padding-top: 15px;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
        }

        @media print {
            body {
                padding: 0;
                margin: 0;
                background: #fff;
            }

            .btn-print {
                display: none;
            }

            .nf-container {
                box-shadow: none;
                margin: 0;
                border: none;
            }
        }

        .btn-print {
            text-align: center;
            margin: 20px auto;
            max-width: 800px;
        }

        .btn-print button {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-family: monospace;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="nf-container">

        <!-- CABECALHO PADRAO PREFEITURA TATUI -->
        <div class="header-prefeitura">
            <div class="brasao">🏛️</div>
            <h1>Prefeitura Municipal de Tatuí</h1>
            <h2>Secretaria da Fazenda</h2>
            <p>Nota Fiscal de Serviços Eletrônica - NFS-e</p>
            <div class="linha"></div>
        </div>

        <!-- DADOS DO PRESTADOR (OFICINA) -->
        <table>
            <tr>
                <td class="borda" style="width: 25%; background: #f0f0f0;">PRESTADOR:</td>
                <td class="borda" colspan="3"><strong>ARY AUTO CENTER</strong></td>
            </tr>
            <tr>
                <td class="borda" style="background: #f0f0f0;">CNPJ:</td>
                <td class="borda" style="width: 35%;">{{ $orcamento['empresa']['documento'] }}</td>
                <td class="borda" style="width: 20%; background: #f0f0f0;">INSC. MUN.:</td>
                <td class="borda" style="width: 20%;">123.456-7</td>
            </tr>
            <tr>
                <td class="borda" style="background: #f0f0f0;">ENDEREÇO:</td>
                <td class="borda" colspan="3">{{ $orcamento['empresa']['endereco'] }}</td>
            </tr>
            <tr>
                <td class="borda" style="background: #f0f0f0;">TELEFONE:</td>
                <td class="borda" colspan="3">{{ $orcamento['empresa']['telefone'] }}</td>
            </tr>
        </table>

        <!-- DADOS DO TOMADOR (CLIENTE) -->
        <table style="margin-top: 8px;">
            <tr>
                <td class="borda" style="width: 25%; background: #f0f0f0;">TOMADOR:</td>
                <td class="borda" colspan="3"><strong>{{ $orcamento['cliente']['nome'] }}</strong></td>
            </tr>
            <tr>
                <td class="borda" style="background: #f0f0f0;">CPF/CNPJ:</td>
                <td class="borda" style="width: 35%;">{{ $orcamento['cliente']['documento'] }}</td>
                <td class="borda" style="width: 20%; background: #f0f0f0;">INSC. MUN.:</td>
                <td class="borda" style="width: 20%;">ISENTO</td>
            </tr>
            <tr>
                <td class="borda" style="background: #f0f0f0;">ENDEREÇO:</td>
                <td class="borda" colspan="3">{{ $orcamento['cliente']['endereco'] ?? 'Nao informado' }} - Tatuí/SP
                </td>
            </tr>
            <tr>
                <td class="borda" style="background: #f0f0f0;">TELEFONE:</td>
                <td class="borda" colspan="3">{{ $orcamento['cliente']['telefone'] }}</td>
            </tr>
        </table>

        <!-- DADOS DO ORCAMENTO -->
        <table style="margin-top: 8px;">
            <tr>
                <td class="borda" style="width: 25%; background: #f0f0f0;">NUMERO ORC:</td>
                <td class="borda" style="width: 25%;">{{ $orcamento['numero'] }}</td>
                <td class="borda" style="width: 25%; background: #f0f0f0;">EMISSAO:</td>
                <td class="borda" style="width: 25%;">{{ $orcamento['emitido_em'] }}</td>
            </tr>
            <tr>
                <td class="borda" style="background: #f0f0f0;">VALIDADE:</td>
                <td class="borda">{{ $orcamento['validade'] }} dias</td>
                <td class="borda" style="background: #f0f0f0;">STATUS:</td>
                <td class="borda">Aguardando aprovacao</td>
            </tr>
        </table>

        <!-- DADOS DO VEICULO -->
        <table style="margin-top: 8px;">
            <tr>
                <td class="borda" style="width: 25%; background: #f0f0f0;">PLACA:</td>
                <td class="borda" style="width: 25%;"><strong>{{ $orcamento['servico']['placa'] }}</strong></td>
                <td class="borda" style="width: 25%; background: #f0f0f0;">VEICULO:</td>
                <td class="borda" style="width: 25%;">{{ $orcamento['servico']['carro'] }}</td>
            </tr>
        </table>

        <!-- TABELA DE SERVICOS -->
        <table style="margin-top: 8px;">
            <tr style="background: #f0f0f0; text-align: center;">
                <td class="borda" style="width: 8%;">ITEM</td>
                <td class="borda" style="width: 52%;">DESCRICAO DO SERVICO</td>
                <td class="borda" style="width: 20%;">VALOR UNIT.</td>
                <td class="borda" style="width: 20%;">VALOR TOTAL</td>
            </tr>
            <tr>
                <td class="borda text-center">01</td>
                <td class="borda">
                    <strong>Alinhamento e Balanceamento</strong><br>
                    <span class="small">{{ $orcamento['servico']['descricao'] }}</span>
                </td>
                <td class="borda text-right">R$ {{ number_format($orcamento['servico']['valor'], 2, ',', '.') }}</td>
                <td class="borda text-right">R$ {{ number_format($orcamento['servico']['valor'], 2, ',', '.') }}</td>
            </tr>
        </table>

        <!-- OBSERVACOES -->
        <table style="margin-top: 8px;">
            <tr>
                <td class="borda" style="background: #f0f0f0; width: 20%;">OBSERVACOES:</td>
                <td class="borda">
                    {{ $orcamento['observacoes'] ?? 'Servico realizado com equipamentos de ultima geracao. Garantia de 90 dias.' }}
                </td>
            </tr>
        </table>

        <!-- TRIBUTACAO E TOTAIS -->
        <table style="margin-top: 8px;">
            <tr>
                <td class="borda" style="width: 50%;">
                    <strong>Base de Calculo (ISS):</strong> R$
                    {{ number_format($orcamento['servico']['valor'], 2, ',', '.') }}<br>
                    <strong>Aliquota ISS (Tatuí/SP):</strong> 5,00%<br>
                    <strong>Valor ISS Retido:</strong> R$
                    {{ number_format($orcamento['servico']['valor'] * 0.05, 2, ',', '.') }}
                </td>
                <td class="borda" style="width: 50%;">
                    <strong>Forma de Pagamento:</strong> Boleto Bancario<br>
                    <strong>Vencimento:</strong> 30 dias<br>
                    <strong>Garantia:</strong> 90 dias
                </td>
            </tr>
        </table>

        <!-- TOTAL -->
        <table style="margin-top: 8px;">
            <tr>
                <td class="borda text-right" style="background: #f0f0f0; width: 70%;">
                    <span class="total">VALOR TOTAL DO ORCAMENTO:</span>
                </td>
                <td class="borda text-right" style="width: 30%;">
                    <span class="total">R$ {{ number_format($orcamento['servico']['valor'], 2, ',', '.') }}</span>
                </td>
            </tr>
        </table>

        <!-- AUTENTICACAO E CODIGO -->
        <table style="margin-top: 8px;">
            <tr>
                <td class="borda text-center small">
                    Documento emitido por sistema emissor de NFS-e<br>
                    Data da emissao: {{ $orcamento['emitido_em'] }} - Horario: {{ date('H:i:s') }}<br>
                    Codigo de autenticacao: {{ strtoupper(substr(md5($orcamento['numero']), 0, 10)) }}
                </td>
            </tr>
        </table>

        <!-- ASSINATURAS -->
        <div class="assinatura">
            <table>
                <tr>
                    <td class="text-center" style="width: 50%;">
                        _________________________________<br>
                        <strong>Cliente / Responsavel</strong><br>
                        {{ $orcamento['cliente']['nome'] }}
                    </td>
                    <td class="text-center" style="width: 50%;">
                        _________________________________<br>
                        <strong>Ary Auto Center</strong><br>
                        Responsavel Tecnico
                    </td>
                </tr>
            </table>
        </div>

        <!-- RODAPE -->
        <div class="linha" style="margin-top: 10px;"></div>
        <div class="text-center small" style="margin-top: 5px;">
            Ary Auto Center - Alinhamento e Balanceamento | Tatuí - SP<br>
            Este documento e valido como orcamento preliminar. Sujeito a alteracoes mediante avaliacao tecnica.
        </div>
    </div>

    <div class="btn-print">
        <button onclick="window.print()">IMPRIMIR ORCAMENTO</button>
    </div>
</body>

</html>
