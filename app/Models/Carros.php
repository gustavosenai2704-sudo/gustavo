<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carros extends Model
{
    protected $table = "carros";

    protected $fillable = [
        "placa",
        "proprietario",
        "carro",
        "preco",
        "renavam"
    ];
}
