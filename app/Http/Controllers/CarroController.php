<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarroController extends Controller
{
    public function carros (Request $request){
        return view('carros');
    
        $request->validate([
        "placa" => "required",
        "proprietario" => "required",
        "carro" => "required",
        "preco" => "required",
        "renavam" => "required"
    ]);
    }
}
