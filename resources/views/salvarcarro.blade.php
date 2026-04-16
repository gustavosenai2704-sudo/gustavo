<x-app-layout>
    <div style="background: linear-gradient(135deg, #e8e8e8 0%, #d4d4d4 100%); min-height: 100vh; padding: 40px 0;">
        <div class="container">
            <div class="row g-4">
                <!-- PAINEL LATERAL INFORMATIVO -->
                <div class="col-lg-4">
                    <div
                        style="background: #ffffff; border-radius: 12px; padding: 25px; border-top: 4px solid #dc3545; height: 100%; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <div
                            style="background: #f8f9fa; display: inline-block; padding: 5px 12px; border-radius: 5px; margin-bottom: 15px;">
                            <span style="color: #dc3545; font-weight: 600; font-size: 0.8rem;">NOVA ORDEM</span>
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-weight: 700; font-size: 1.3rem;">Entrada de
                            serviço</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 25px;">
                            Registre placa, modelo do carro, valor cobrado, data e o serviço executado no atendimento.
                        </p>

                        <div style="background: #f8f9fa; border-radius: 8px; padding: 18px; border: 1px solid #dee2e6;">
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                                <span style="font-size: 20px; font-weight: bold; color: #dc3545;">+</span>
                                <span style="color: #dc3545; font-weight: 600;">Atendimento rápido</span>
                            </div>
                            <div style="font-size: 24px; color: #dc3545; font-weight: 700; margin-bottom: 8px;">
                                {{ now()->format('d/m/Y') }}
                            </div>
                            <p style="color: #666; margin: 0; font-size: 12px;">Sistema pronto para receber novos
                                serviços</p>
                        </div>
                    </div>
                </div>

                <!-- FORMULARIO PRINCIPAL -->
                <div class="col-lg-8">
                    <div
                        style="background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">

                        @if (session('success'))
                            <div
                                style="background: #d4edda; color: #155724; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #28a745;">
                                {{ session('success') }}
                            </div>

                            @if (session('servico_novo_id'))
                                <div
                                    style="background: #e8f4fd; border: 1px solid #bee5eb; color: #0c5460; padding: 15px 20px; border-radius: 8px; margin-bottom: 25px;">
                                    <div
                                        style="font-size: 0.85rem; color: #dc3545; margin-bottom: 8px; font-weight: 600;">
                                        NFS-e do serviço recém-cadastrado</div>
                                    <div style="margin-bottom: 12px;">Serviço #{{ session('servico_novo_id') }} da placa
                                        <strong>{{ session('servico_novo_placa') }}</strong> pronto para emissão.</div>
                                    <a href="{{ route('emitir.nfse', session('servico_novo_id')) }}" class="btn"
                                        style="background: #dc3545; color: #fff; padding: 8px 20px; border-radius: 6px; font-weight: 600; font-size: 13px; text-decoration: none; display: inline-block;">
                                        Emitir NFS-e agora
                                    </a>
                                </div>
                            @endif
                        @endif

                        <form method="POST" action="{{ route('carros.store') }}" class="row g-4">
                            @csrf

                            <div class="col-md-6">
                                <label for="placa" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    PLACA DO VEICULO
                                </label>
                                <input id="placa" name="placa" type="text" inputmode="text"
                                    class="form-control @error('placa') is-invalid @enderror"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('placa') }}" required placeholder="ABC-1234">
                                @error('placa')
                                    <div class="invalid-feedback d-block"
                                        style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="carro" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    MODELO DO CARRO
                                </label>
                                <input id="carro" name="carro" type="text"
                                    class="form-control @error('carro') is-invalid @enderror"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('carro') }}" required placeholder="Ex: Honda Civic">
                                @error('carro')
                                    <div class="invalid-feedback d-block"
                                        style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="preco" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    VALOR DO SERVICO
                                </label>
                                <input id="preco" name="preco" type="text" inputmode="decimal"
                                    class="form-control @error('preco') is-invalid @enderror"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('preco') }}" required placeholder="R$ 0,00">
                                @error('preco')
                                    <div class="invalid-feedback d-block"
                                        style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_servico" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    DATA DO SERVICO
                                </label>
                                <input id="data_servico" name="data_servico" type="date"
                                    class="form-control @error('data_servico') is-invalid @enderror"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('data_servico') }}" required>
                                @error('data_servico')
                                    <div class="invalid-feedback d-block"
                                        style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="servico" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    SERVICO REALIZADO
                                </label>
                                <textarea id="servico" name="servico" class="form-control @error('servico') is-invalid @enderror" rows="5"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; resize: vertical; transition: all 0.3s;"
                                    required placeholder="Descreva detalhadamente o serviço executado...">{{ old('servico') }}</textarea>
                                @error('servico')
                                    <div class="invalid-feedback d-block"
                                        style="color: #dc3545; font-size: 12px; margin-top: 5px;">{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn"
                                    style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #fff; border: none; padding: 12px 35px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.3s;">
                                    SALVAR SERVICO
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.nfse-cliente-modal')

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

        /* Efeito hover para botoes */
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        button[type="submit"]:hover {
            background: #b02a37 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }

        /* Estilizacao do placeholder */
        ::placeholder {
            color: #999 !important;
            font-size: 12px;
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

        /* Responsividade */
        @media (max-width: 768px) {

            .col-lg-4>div,
            .col-lg-8>div {
                padding: 20px !important;
            }

            button[type="submit"] {
                width: 100%;
            }

            .d-flex.flex-wrap {
                justify-content: center;
            }
        }

        /* Estilo para o alerta de sucesso */
        .alert-success-custom {
            background: #d4edda;
            border-left: 4px solid #28a745;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const placaInput = document.getElementById('placa');
            const precoInput = document.getElementById('preco');

            const formatarPlaca = function(valor) {
                const placa = valor.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 7);
                if (placa.length <= 3) return placa;
                return placa.slice(0, 3) + '-' + placa.slice(3);
            };

            const formatarPreco = function(valor) {
                const digitos = valor.replace(/\D/g, '');
                if (digitos === '') return '';
                const numero = (parseInt(digitos, 10) / 100).toFixed(2);
                return numero.replace('.', ',');
            };

            if (placaInput) {
                placaInput.addEventListener('input', function(e) {
                    e.target.value = formatarPlaca(e.target.value);
                });
                placaInput.value = formatarPlaca(placaInput.value);
            }

            if (precoInput) {
                precoInput.addEventListener('input', function(e) {
                    e.target.value = formatarPreco(e.target.value);
                });
                precoInput.form?.addEventListener('submit', function() {
                    precoInput.value = precoInput.value.replace('.', '').replace(',', '.');
                });
                precoInput.value = formatarPreco(precoInput.value);
            }
        });
    </script>
</x-app-layout>
