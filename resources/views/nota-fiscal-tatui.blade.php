@php
    $brasao = public_path('images/brasao-tatui.svg');
    $formatarMoeda = fn ($valor) => 'R$ ' . number_format((float) $valor, 2, ',', '.');
@endphp
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $nfse['numero'] }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #000; background: #fff; margin: 18px; }
        .nota { border: 1px solid #000; padding: 10px; }
        .cabecalho { width: 100%; border-bottom: 1px solid #000; padding-bottom: 10px; margin-bottom: 10px; }
        .cabecalho td { vertical-align: top; }
        .titulo-central { text-align: center; padding: 0 12px; }
        .titulo-central h1, .titulo-central h2, .titulo-central p { margin: 0; }
        .titulo-central h1 { font-size: 14px; font-weight: 700; margin-bottom: 3px; }
        .titulo-central h2 { font-size: 13px; font-weight: 700; margin-bottom: 4px; }
        .box-numero { width: 190px; border: 1px solid #000; background: #f0f0f0; padding: 6px 8px; }
        .box-numero strong { display: block; font-size: 13px; margin-top: 3px; }
        .secao { border: 1px solid #000; margin-bottom: 8px; }
        .secao-titulo { background: #f0f0f0; border-bottom: 1px solid #000; padding: 4px 6px; font-weight: 700; text-transform: uppercase; font-size: 10px; }
        .secao-corpo { padding: 6px; }
        .campo { margin-bottom: 6px; }
        .rotulo { font-weight: 700; }
        table.tabela { width: 100%; border-collapse: collapse; }
        table.tabela th, table.tabela td { border: 1px solid #000; padding: 5px; font-size: 10px; }
        table.tabela th { background: #f0f0f0; text-align: left; }
        .autenticidade { margin-top: 6px; background: #f0f0f0; border: 1px solid #000; padding: 6px; }
        .rodape { border-top: 1px solid #000; margin-top: 10px; padding-top: 8px; font-size: 10px; }
    </style>
</head>
<body>
    <div class="nota">
        <table class="cabecalho" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width: 70px;"><img src="{{ $brasao }}" alt="Brasao da Prefeitura de Tatui" style="width: 64px; height: auto;"></td>
                <td class="titulo-central">
                    <h1>Prefeitura Municipal de Tatui - Secretaria da Fazenda</h1>
                    <h2>Sistema de Gestao de Notas Fiscais de Servicos Eletronicas - NFS-e</h2>
                    <p>Documento interno de emissao visual para controle da oficina</p>
                </td>
                <td><div class="box-numero">Numero da NFS-e<strong>{{ $nfse['numero'] }}</strong><div>Emissao: {{ $nfse['data_emissao']->format('d/m/Y H:i:s') }}</div></div></td>
            </tr>
        </table>
        <div class="secao"><div class="secao-titulo">Prestador de Servicos</div><div class="secao-corpo"><div class="campo"><span class="rotulo">Nome/Razao Social:</span> {{ $nfse['prestador']['nome'] }}</div><div class="campo"><span class="rotulo">CNPJ:</span> {{ $nfse['prestador']['cnpj'] }}</div><div class="campo"><span class="rotulo">Inscricao Municipal:</span> {{ $nfse['prestador']['inscricao_municipal'] }}</div><div class="campo"><span class="rotulo">Endereco:</span> {{ $nfse['prestador']['endereco'] }}</div></div></div>
        <div class="secao"><div class="secao-titulo">Tomador de Servicos</div><div class="secao-corpo"><div class="campo"><span class="rotulo">Nome/Razao Social:</span> {{ $nfse['tomador']['nome'] }}</div><div class="campo"><span class="rotulo">CPF/CNPJ:</span> {{ $nfse['tomador']['documento'] }}</div><div class="campo"><span class="rotulo">Endereco:</span> {{ $nfse['tomador']['endereco'] }}</div></div></div>
        <div class="secao"><div class="secao-titulo">Detalhes do Servico</div><div class="secao-corpo"><table class="tabela"><thead><tr><th>Descricao do Servico</th><th>Codigo CNAE/LC 116</th><th>Data</th><th>Placa</th><th>Veiculo</th></tr></thead><tbody><tr><td>{{ $nfse['servico']['descricao'] }}</td><td>{{ $nfse['servico']['codigo'] }} - {{ $nfse['servico']['codigo_descricao'] }}</td><td>{{ $nfse['servico']['data']->format('d/m/Y') }}</td><td>{{ $nfse['servico']['placa'] }}</td><td>{{ $nfse['servico']['veiculo'] }}</td></tr></tbody></table><div style="margin-top: 8px;"><span class="rotulo">Descricao detalhada:</span> {{ $nfse['servico']['descricao_detalhada'] }}</div></div></div>
        <div class="secao"><div class="secao-titulo">Tributacao e Totais</div><div class="secao-corpo"><div class="campo"><span class="rotulo">Base de calculo do ISS:</span> {{ $formatarMoeda($nfse['tributacao']['base_calculo']) }}</div><div class="campo"><span class="rotulo">Aliquota ISS:</span> {{ number_format($nfse['tributacao']['aliquota_iss'], 2, ',', '.') }}%</div><div class="campo"><span class="rotulo">Valor do ISS:</span> {{ $formatarMoeda($nfse['tributacao']['valor_iss']) }}</div><div class="campo"><span class="rotulo">ISS retido na fonte:</span> {{ $formatarMoeda($nfse['tributacao']['valor_iss_retido']) }}</div><div class="campo"><span class="rotulo">Valor do servico:</span> {{ $formatarMoeda($nfse['totais']['valor_servico']) }}</div><div class="campo"><span class="rotulo">Desconto:</span> {{ $formatarMoeda($nfse['totais']['desconto']) }}</div><div class="campo"><span class="rotulo">Valor liquido da nota:</span> {{ $formatarMoeda($nfse['totais']['valor_liquido']) }}</div></div></div>
        <div class="autenticidade"><div><strong>Codigo de verificacao:</strong> {{ $nfse['codigo_verificacao'] }}</div><div><strong>Codigo de autenticidade:</strong> {{ $nfse['codigo_verificacao'] }}</div></div>
        <div class="rodape"><div>Documento emitido por sistema emissor de NFS-e</div><div>Data e hora da emissao: {{ $nfse['data_emissao']->format('d/m/Y H:i:s') }}</div><div>Codigo de autenticidade: {{ $nfse['codigo_verificacao'] }}</div></div>
    </div>
</body>
</html>
