<x-app-layout>
    <div style="background: linear-gradient(135deg, #e8e8e8 0%, #d4d4d4 100%); min-height: 100vh; padding: 40px 0;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div
                        style="background: #ffffff; border-radius: 12px; padding: 25px; border-top: 4px solid #dc3545; box-shadow: 0 5px 15px rgba(0,0,0,0.1); height: 100%;">
                        <div
                            style="background: #f8f9fa; display: inline-block; padding: 5px 12px; border-radius: 5px; margin-bottom: 15px;">
                            <span style="color: #dc3545; font-weight: 600; font-size: 0.8rem;">ORCAMENTO PDF</span>
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-weight: 700; font-size: 1.3rem;">Gerar orcamento</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 0;">
                            Monte um orcamento em PDF com os dados do veiculo, do cliente e o valor estimado do servico.
                        </p>

                        <div
                            style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 8px; border-left: 3px solid #ffc107;">
                            <div style="font-size: 11px; color: #666;">
                                <strong style="color: #dc3545;">Informacao:</strong><br>
                                Ao selecionar um servico existente, os dados do veiculo e do valor sao preenchidos automaticamente.
                            </div>
                        </div>
                    </div>
                </div>

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

                        <form method="POST" action="{{ route('budget.pdf') }}" class="row g-4">
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
                                        <option value="{{ $servico->id }}" data-placa="{{ $servico->placa }}"
                                            data-carro="{{ $servico->carro }}"
                                            data-data-servico="{{ $servico->data_servico?->format('Y-m-d') }}"
                                            data-descricao-servico="{{ $servico->servico }}"
                                            data-valor-estimado="{{ number_format($servico->preco, 2, ',', '') }}"
                                            @selected(old('servico_id', request('servico_id')) == $servico->id)>
                                            #{{ $servico->id }} - {{ $servico->placa }} - {{ $servico->carro }} - R$
                                            {{ number_format($servico->preco, 2, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="placa" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">PLACA</label>
                                <input id="placa" name="placa" type="text"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('placa') }}" placeholder="ABC-1234" required>
                            </div>

                            <div class="col-md-4">
                                <label for="carro" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">CARRO</label>
                                <input id="carro" name="carro" type="text"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('carro') }}" placeholder="Modelo do veiculo" required>
                            </div>

                            <div class="col-md-4">
                                <label for="data_servico" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">DATA DO SERVICO</label>
                                <input id="data_servico" name="data_servico" type="date"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('data_servico') }}">
                            </div>

                            <div class="col-md-6">
                                <label for="cliente_nome" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">NOME DO CLIENTE</label>
                                <input id="cliente_nome" name="cliente_nome" type="text"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('cliente_nome') }}" placeholder="Digite o nome completo" required>
                            </div>

                            <div class="col-md-6">
                                <label for="cliente_documento" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">CPF / CNPJ</label>
                                <input id="cliente_documento" name="cliente_documento" type="text" inputmode="numeric"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('cliente_documento') }}"
                                    placeholder="000.000.000-00 ou 00.000.000/0000-00">
                            </div>

                            <div class="col-md-6">
                                <label for="cliente_telefone" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">TELEFONE</label>
                                <input id="cliente_telefone" name="cliente_telefone" type="text" inputmode="tel"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('cliente_telefone') }}" placeholder="(00) 00000-0000">
                            </div>

                            <div class="col-md-6">
                                <label for="validade" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">VALIDADE DO ORCAMENTO</label>
                                <select id="validade" name="validade" class="form-select"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; cursor: pointer;"
                                    required>
                                    <option value="">Selecione</option>
                                    <option value="3 dias" @selected(old('validade') === '3 dias')>3 dias</option>
                                    <option value="5 dias" @selected(old('validade') === '5 dias')>5 dias</option>
                                    <option value="7 dias" @selected(old('validade') === '7 dias')>7 dias</option>
                                    <option value="15 dias" @selected(old('validade') === '15 dias')>15 dias</option>
                                    <option value="30 dias" @selected(old('validade') === '30 dias')>30 dias</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="valor_estimado" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">VALOR ESTIMADO</label>
                                <input id="valor_estimado" name="valor_estimado" type="text" inputmode="numeric"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; transition: all 0.3s;"
                                    value="{{ old('valor_estimado') }}" placeholder="R$ 0,00" required>
                            </div>

                            <div class="col-12">
                                <label for="descricao_servico" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">DESCRICAO DO SERVICO</label>
                                <textarea id="descricao_servico" name="descricao_servico" rows="5"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; resize: vertical; transition: all 0.3s;"
                                    placeholder="Descreva o servico previsto..." required>{{ old('descricao_servico') }}</textarea>
                            </div>

                            <div class="col-12">
                                <label for="observacoes" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">OBSERVACOES DO ORCAMENTO</label>
                                <textarea id="observacoes" name="observacoes" rows="4"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 12px; width: 100%; resize: vertical; transition: all 0.3s;"
                                    placeholder="Observacoes adicionais para o orcamento...">{{ old('observacoes') }}</textarea>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit"
                                    style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #fff; border: none; padding: 12px 35px; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.3s;">
                                    GERAR ORCAMENTO EM PDF
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
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

        button[type="submit"]:hover {
            background: #b02a37 !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }

        select:hover {
            background: #ffffff !important;
        }

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

        ::placeholder {
            color: #999 !important;
            font-size: 12px;
        }

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
            const servicoSelect = document.getElementById('servico_id');
            const telefoneInput = document.getElementById('cliente_telefone');
            const documentoInput = document.getElementById('cliente_documento');
            const placaInput = document.getElementById('placa');
            const carroInput = document.getElementById('carro');
            const dataServicoInput = document.getElementById('data_servico');
            const descricaoServicoInput = document.getElementById('descricao_servico');
            const valorEstimadoInput = document.getElementById('valor_estimado');

            const formatarTelefone = function(valor) {
                const digitos = valor.replace(/\D/g, '').slice(0, 11);
                if (digitos.length === 0) return '';
                if (digitos.length <= 2) return '(' + digitos;
                if (digitos.length <= 6) return '(' + digitos.slice(0, 2) + ') ' + digitos.slice(2);
                if (digitos.length <= 10) return '(' + digitos.slice(0, 2) + ') ' + digitos.slice(2, 6) + '-' + digitos.slice(6);
                return '(' + digitos.slice(0, 2) + ') ' + digitos.slice(2, 7) + '-' + digitos.slice(7);
            };

            const formatarDocumento = function(valor) {
                const digitos = valor.replace(/\D/g, '').slice(0, 14);
                if (digitos.length <= 11) {
                    if (digitos.length <= 3) return digitos;
                    if (digitos.length <= 6) return digitos.slice(0, 3) + '.' + digitos.slice(3);
                    if (digitos.length <= 9) return digitos.slice(0, 3) + '.' + digitos.slice(3, 6) + '.' + digitos.slice(6);
                    return digitos.slice(0, 3) + '.' + digitos.slice(3, 6) + '.' + digitos.slice(6, 9) + '-' + digitos.slice(9);
                }
                if (digitos.length <= 2) return digitos;
                if (digitos.length <= 5) return digitos.slice(0, 2) + '.' + digitos.slice(2);
                if (digitos.length <= 8) return digitos.slice(0, 2) + '.' + digitos.slice(2, 5) + '.' + digitos.slice(5);
                if (digitos.length <= 12) return digitos.slice(0, 2) + '.' + digitos.slice(2, 5) + '.' + digitos.slice(5, 8) + '/' + digitos.slice(8);
                return digitos.slice(0, 2) + '.' + digitos.slice(2, 5) + '.' + digitos.slice(5, 8) + '/' + digitos.slice(8, 12) + '-' + digitos.slice(12);
            };

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

            if (placaInput) {
                placaInput.addEventListener('input', function(e) {
                    e.target.value = formatarPlaca(e.target.value);
                });
                placaInput.value = formatarPlaca(placaInput.value);
            }

            if (valorEstimadoInput) {
                valorEstimadoInput.addEventListener('input', function(e) {
                    e.target.value = formatarPreco(e.target.value);
                });
                valorEstimadoInput.form?.addEventListener('submit', function() {
                    valorEstimadoInput.value = valorEstimadoInput.value.replace('.', '').replace(',', '.');
                });
                valorEstimadoInput.value = formatarPreco(valorEstimadoInput.value);
            }

            if (servicoSelect) {
                servicoSelect.addEventListener('change', function() {
                    const opcao = servicoSelect.options[servicoSelect.selectedIndex];
                    if (!opcao || !opcao.value) return;
                    if (!placaInput.value) placaInput.value = formatarPlaca(opcao.dataset.placa || '');
                    if (!carroInput.value) carroInput.value = opcao.dataset.carro || '';
                    if (!dataServicoInput.value) dataServicoInput.value = opcao.dataset.dataServico || '';
                    if (!descricaoServicoInput.value) descricaoServicoInput.value = opcao.dataset.descricaoServico || '';
                    if (!valorEstimadoInput.value) valorEstimadoInput.value = formatarPreco(opcao.dataset.valorEstimado || '');
                });

                if (servicoSelect.value) servicoSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
</x-app-layout>
