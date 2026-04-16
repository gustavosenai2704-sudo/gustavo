<x-app-layout>
    <div style="background: linear-gradient(135deg, #e8e8e8 0%, #d4d4d4 100%); min-height: 100vh; padding: 40px 0;">
        <div class="container">
            <div class="row g-4">
                <!-- PAINEL LATERAL -->
                <div class="col-lg-4">
                    <div
                        style="background: #ffffff; border-radius: 12px; padding: 25px; border-top: 4px solid #dc3545; box-shadow: 0 5px 15px rgba(0,0,0,0.1); height: 100%;">
                        <div
                            style="background: #f8f9fa; display: inline-block; padding: 5px 12px; border-radius: 5px; margin-bottom: 15px;">
                            <span style="color: #dc3545; font-weight: 600; font-size: 0.8rem;">FATURA PDF</span>
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-weight: 700; font-size: 1.3rem;">Gerar
                            documento</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 0;">
                            Selecione um serviço para montar uma fatura em PDF com os dados da oficina e do atendimento.
                        </p>

                        <div
                            style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 8px; border-left: 3px solid #ffc107;">
                            <div style="font-size: 11px; color: #666;">
                                <strong style="color: #dc3545;">Informação:</strong><br>
                                A fatura será gerada no formato PDF com todos os dados do serviço e do cliente.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO PRINCIPAL -->
                <div class="col-lg-8">
                    <div
                        style="background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">

                        @if ($errors->any())
                            <div
                                style="background: #f8d7da; border-left: 4px solid #dc3545; padding: 15px 20px; border-radius: 8px; margin-bottom: 25px;">
                                <ul style="margin: 0; padding-left: 20px; color: #721c24;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('invoice.pdf') }}" class="row g-4">
                            @csrf

                            <div class="col-12">
                                <label for="servico_id" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    SERVICO DA OFICINA
                                </label>
                                <select id="servico_id" name="servico_id" class="form-select"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; cursor: pointer;">
                                    <option value="">Selecione um servico</option>
                                    @foreach ($servicos as $servico)
                                        <option value="{{ $servico->id }}" @selected(old('servico_id') == $servico->id)>
                                            #{{ $servico->id }} - {{ $servico->placa }} - {{ $servico->carro }} - R$
                                            {{ number_format($servico->preco, 2, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="cliente_nome" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    NOME DO CLIENTE
                                </label>
                                <input id="cliente_nome" name="cliente_nome" type="text"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('cliente_nome') }}" placeholder="Digite o nome completo" required>
                            </div>

                            <div class="col-md-6">
                                <label for="cliente_documento" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    CPF / CNPJ
                                </label>
                                <input id="cliente_documento" name="cliente_documento" type="text" inputmode="numeric"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('cliente_documento') }}"
                                    placeholder="000.000.000-00 ou 00.000.000/0000-00">
                            </div>

                            <div class="col-md-6">
                                <label for="cliente_telefone" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    TELEFONE
                                </label>
                                <input id="cliente_telefone" name="cliente_telefone" type="text" inputmode="tel"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('cliente_telefone') }}" placeholder="(00) 00000-0000">
                            </div>

                            <div class="col-md-6">
                                <label for="forma_pagamento" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    FORMA DE PAGAMENTO
                                </label>
                                <select id="forma_pagamento" name="forma_pagamento" class="form-select"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; cursor: pointer;"
                                    required>
                                    <option value="">Selecione</option>
                                    <option value="Dinheiro" @selected(old('forma_pagamento') === 'Dinheiro')>Dinheiro</option>
                                    <option value="Pix" @selected(old('forma_pagamento') === 'Pix')>Pix</option>
                                    <option value="Cartao de debito" @selected(old('forma_pagamento') === 'Cartao de debito')>Cartao de debito
                                    </option>
                                    <option value="Cartao de credito" @selected(old('forma_pagamento') === 'Cartao de credito')>Cartao de credito
                                    </option>
                                    <option value="Boleto" @selected(old('forma_pagamento') === 'Boleto')>Boleto</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="observacoes" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    OBSERVACOES DA FATURA
                                </label>
                                <textarea id="observacoes" name="observacoes" rows="4"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; resize: vertical; transition: all 0.3s;"
                                    placeholder="Observacoes adicionais para a fatura...">{{ old('observacoes') }}</textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit"
                                    style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #fff; border: none; padding: 12px 35px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.3s;">
                                    GERAR FATURA EM PDF
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Efeitos hover para inputs */
        input:hover,
        select:hover,
        textarea:hover {
            border-color: #ffc107 !important;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
            background: #ffffff !important;
        }

        /* Efeito hover para o botao */
        button[type="submit"]:hover {
            background: #b02a37 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }

        /* Efeito hover para select */
        select:hover {
            background: #ffffff !important;
        }

        /* Animacao de entrada */
        .col-lg-4>div,
        .col-lg-8>div {
            animation: fadeInUp 0.4s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estilizacao do placeholder */
        ::placeholder {
            color: #999 !important;
            font-size: 12px;
        }

        /* Responsividade */
        @media (max-width: 768px) {

            .col-lg-4>div,
            .col-lg-8>div {
                padding: 20px !important;
            }

            button[type="submit"] {
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const telefoneInput = document.getElementById('cliente_telefone');
            const documentoInput = document.getElementById('cliente_documento');

            const formatarTelefone = function(valor) {
                const digitos = valor.replace(/\D/g, '').slice(0, 11);
                if (digitos.length === 0) return '';
                if (digitos.length <= 2) return '(' + digitos;
                if (digitos.length <= 6) return '(' + digitos.slice(0, 2) + ') ' + digitos.slice(2);
                if (digitos.length <= 10) return '(' + digitos.slice(0, 2) + ') ' + digitos.slice(2, 6) + '-' +
                    digitos.slice(6);
                return '(' + digitos.slice(0, 2) + ') ' + digitos.slice(2, 7) + '-' + digitos.slice(7);
            };

            const formatarDocumento = function(valor) {
                const digitos = valor.replace(/\D/g, '').slice(0, 14);
                if (digitos.length <= 11) {
                    if (digitos.length <= 3) return digitos;
                    if (digitos.length <= 6) return digitos.slice(0, 3) + '.' + digitos.slice(3);
                    if (digitos.length <= 9) return digitos.slice(0, 3) + '.' + digitos.slice(3, 6) + '.' +
                        digitos.slice(6);
                    return digitos.slice(0, 3) + '.' + digitos.slice(3, 6) + '.' + digitos.slice(6, 9) + '-' +
                        digitos.slice(9);
                }
                if (digitos.length <= 2) return digitos;
                if (digitos.length <= 5) return digitos.slice(0, 2) + '.' + digitos.slice(2);
                if (digitos.length <= 8) return digitos.slice(0, 2) + '.' + digitos.slice(2, 5) + '.' + digitos
                    .slice(5);
                if (digitos.length <= 12) return digitos.slice(0, 2) + '.' + digitos.slice(2, 5) + '.' + digitos
                    .slice(5, 8) + '/' + digitos.slice(8);
                return digitos.slice(0, 2) + '.' + digitos.slice(2, 5) + '.' + digitos.slice(5, 8) + '/' +
                    digitos.slice(8, 12) + '-' + digitos.slice(12);
            };

            if (telefoneInput) {
                telefoneInput.addEventListener('input', function(e) {
                    e.target.value = formatarTelefone(e.target.value);
                });
                telefoneInput.value = formatarTelefone(telefoneInput.value);
            }

            if (documentoInput) {
                documentoInput.addEventListener('input', function(e) {
                    e.target.value = formatarDocumento(e.target.value);
                });
                documentoInput.value = formatarDocumento(documentoInput.value);
            }
        });
    </script>
</x-app-layout>
