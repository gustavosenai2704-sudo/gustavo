



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $fatura['numero'] }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #222; font-size: 12px; margin: 28px; }
        .topbar { background: #1f2933; color: #fff; padding: 18px 22px; border-radius: 8px; margin-bottom: 22px; }
        .title { font-size: 26px; font-weight: bold; margin: 0 0 6px; }
        .subtitle { font-size: 12px; margin: 0; opacity: 0.9; }
        .grid { width: 100%; margin-bottom: 18px; }
        .card { width: 48%; vertical-align: top; display: inline-block; background: #f6f7f9; border: 1px solid #d9dee5; border-radius: 8px; padding: 14px 16px; min-height: 120px; }
        .card + .card { margin-left: 3%; }
        .label { color: #6b7280; font-size: 10px; text-transform: uppercase; margin-bottom: 6px; }
        .value { margin-bottom: 8px; }
        .section-title { font-size: 14px; font-weight: bold; margin: 24px 0 12px; padding-bottom: 6px; border-bottom: 2px solid #1f2933; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #1f2933; color: #fff; text-align: left; padding: 10px; font-size: 11px; }
        td { border: 1px solid #d9dee5; padding: 10px; vertical-align: top; }
        .total-box { margin-top: 16px; text-align: right; }
        .total-box strong { display: inline-block; background: #111827; color: #fff; padding: 12px 18px; border-radius: 8px; font-size: 16px; }
        .footer { margin-top: 30px; font-size: 11px; color: #6b7280; text-align: center; }
    </style>
</head>
<body>
    <div class="topbar">
        <p class="title">Fatura de Servico</p>
        <p class="subtitle">Documento emitido pela oficina para registro do atendimento</p>
    </div>
    <table class="grid"><tr><td class="card"><div class="label">Empresa</div><div class="value"><strong>{{ $fatura['empresa']['nome'] }}</strong></div><div class="value">CNPJ: {{ $fatura['empresa']['documento'] }}</div><div class="value">Telefone: {{ $fatura['empresa']['telefone'] }}</div><div class="value">Endereco: {{ $fatura['empresa']['endereco'] }}</div></td><td class="card"><div class="label">Fatura</div><div class="value"><strong>{{ $fatura['numero'] }}</strong></div><div class="value">Emitida em: {{ $fatura['emitida_em'] }}</div><div class="value">Pagamento: {{ $fatura['forma_pagamento'] }}</div><div class="value">Garantia ate: {{ $fatura['servico']['garantia'] }}</div></td></tr></table>
    <table class="grid"><tr><td class="card" style="width: 100%; display: block; margin: 0;"><div class="label">Cliente</div><div class="value"><strong>{{ $fatura['cliente']['nome'] }}</strong></div><div class="value">Documento: {{ $fatura['cliente']['documento'] }}</div><div class="value">Telefone: {{ $fatura['cliente']['telefone'] }}</div></td></tr></table>
    <div class="section-title">Detalhes do servico</div>
    <table><thead><tr><th style="width: 12%;">ID</th><th style="width: 14%;">Data</th><th style="width: 16%;">Placa</th><th style="width: 18%;">Carro</th><th>Descricao</th><th style="width: 16%;">Valor</th></tr></thead><tbody><tr><td>{{ $fatura['servico']['id'] ?? '-' }}</td><td>{{ $fatura['servico']['data'] }}</td><td>{{ $fatura['servico']['placa'] }}</td><td>{{ $fatura['servico']['carro'] }}</td><td>{{ $fatura['servico']['descricao'] }}</td><td>R$ {{ number_format($fatura['servico']['valor'], 2, ',', '.') }}</td></tr></tbody></table>
    <div class="section-title">Observacoes</div>
    <table><tbody><tr><td>{{ $fatura['observacoes'] }}</td></tr></tbody></table>
    <div class="total-box"><strong>Total: R$ {{ number_format($fatura['servico']['valor'], 2, ',', '.') }}</strong></div>
    <div class="footer">Ary Auto Center - Documento gerado automaticamente em {{ $fatura['emitida_em'] }}</div>
</body>
</html>
