<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Carros extends Model
{
    protected $table = "carros";

    protected $fillable = [
        "placa",
        "carro",
        "preco",
        "servico",
        "data_servico",
        "numero_nf",
        "cpf_cliente",
        "nome_cliente",
        "endereco_cliente",
        "codigo_verificacao",
        "data_emissao",
    ];

    protected $casts = [
        'data_servico' => 'date',
        'data_emissao' => 'datetime',
    ];

    public function getGarantiaFimAttribute(): Carbon
    {
        return $this->data_servico->copy()->addMonthsNoOverflow(3);
    }

    public function getGarantiaExpiradaAttribute(): bool
    {
        return now()->startOfDay()->gt($this->garantia_fim);
    }

    public function getGarantiaDiasRestantesAttribute(): int
    {
        return now()->startOfDay()->diffInDays($this->garantia_fim, false);
    }
}
