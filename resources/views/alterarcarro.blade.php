<x-app-layout>
    <div style="background: linear-gradient(135deg, #e8e8e8 0%, #d4d4d4 100%); min-height: 100vh; padding: 40px 0;">
        <div class="container">
            <div class="row g-4">
                <!-- FormulÃ¡rio de alteraÃ§Ã£o -->
                <div class="col-lg-6">
                    <div style="background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); height: 100%;">
                        @if (session('success'))
                            <div style="background: #d4edda; color: #155724; padding: 15px 20px; border-radius: 8px; margin-bottom: 30px; border-left: 4px solid #28a745; font-weight: 500;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div style="background: #f8d7da; color: #721c24; padding: 15px 20px; border-radius: 8px; margin-bottom: 30px; border-left: 4px solid #dc3545;">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div style="margin-bottom: 25px;">
                            <label for="buscar_placa" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                Buscar serviÃ§o pela placa
                            </label>
                            <div class="row g-2 align-items-end">
                                <div class="col-sm-8">
                                    <input id="buscar_placa" type="text" class="form-control" style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 15px;" placeholder="ABC-1234">
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" id="buscar-carro" class="btn w-100" style="background: #dc3545; color: #fff; padding: 10px; border-radius: 8px; font-weight: 600;">
                                        Buscar
                                    </button>
                                </div>
                            </div>
                            <div id="mensagem-busca" class="d-none alert mt-3 mb-0" style="border-radius: 8px;"></div>
                        </div>

                        <form method="POST" action="{{ route('carros.update') }}" class="row g-4">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6">
                                <label for="id" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    ID do serviÃ§o
                                </label>
                                <input id="id" name="id" type="number" class="form-control @error('id') is-invalid @enderror" 
                                    style="background: #e9ecef; color: #666; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('id') }}" required readonly>
                                @error('id')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="placa" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    Placa
                                </label>
                                <input id="placa" name="placa" type="text" inputmode="text" class="form-control @error('placa') is-invalid @enderror" 
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('placa') }}" required>
                                @error('placa')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="carro" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    Carro
                                </label>
                                <input id="carro" name="carro" type="text" class="form-control @error('carro') is-invalid @enderror" 
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('carro') }}" required>
                                @error('carro')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="preco" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    PreÃ§o
                                </label>
                                <input id="preco" name="preco" type="text" inputmode="decimal" class="form-control @error('preco') is-invalid @enderror" 
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('preco') }}" required>
                                @error('preco')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_servico" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    Data do serviÃ§o
                                </label>
                                <input id="data_servico" name="data_servico" type="date" class="form-control @error('data_servico') is-invalid @enderror" 
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 15px;" 
                                    value="{{ old('data_servico') }}" required>
                                @error('data_servico')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="servico" class="form-label" style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    ServiÃ§o realizado
                                </label>
                                <textarea id="servico" name="servico" class="form-control @error('servico') is-invalid @enderror" rows="5" 
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 10px 15px; resize: vertical;" 
                                    required>{{ old('servico') }}</textarea>
                                @error('servico')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn" style="background: #ffc107; color: #000; padding: 12px 35px; border-radius: 8px; font-weight: 700; font-size: 16px; transition: all 0.3s;">
                                    Alterar serviÃ§o
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Lista de serviÃ§os cadastrados -->
                <div class="col-lg-6">
                    <div style="background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); height: 100%;">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <div style="background: #f8f9fa; display: inline-block; padding: 5px 12px; border-radius: 5px; margin-bottom: 10px;">
                                    <span style="color: #dc3545; font-size: 0.8rem; font-weight: 600;">CONSULTA RÃPIDA</span>
                                </div>
                                <h3 style="color: #333; margin: 0; font-weight: 600; font-size: 1.2rem;">ServiÃ§os cadastrados</h3>
                            </div>
                        </div>

                        @if ($carros->isEmpty())
                            <div style="text-align: center; padding: 60px 20px; background: #f8f9fa; border-radius: 8px; border: 2px dashed #dee2e6;">
                                <p style="color: #666; font-size: 1rem; margin: 0;">Nenhum serviÃ§o cadastrado.</p>
                            </div>
                        @else
                            <div class="table-responsive" style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                                    <thead>
                                        <tr style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #ffffff;">
                                            <th style="padding: 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">ID</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">Data</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">Placa</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">Carro</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600;">AÃ§Ã£o</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carros as $index => $item)
                                            <tr style="border-bottom: 1px solid #e0e0e0; background-color: {{ $index % 2 == 0 ? '#ffffff' : '#f8f9fa' }}; transition: all 0.3s;">
                                                <td style="padding: 12px; border-right: 1px solid #e0e0e0; color: #333; font-weight: 500;">#{{ $item->id }}</td>
                                                <td style="padding: 12px; border-right: 1px solid #e0e0e0; color: #555;">{{ $item->data_servico ? \Carbon\Carbon::parse($item->data_servico)->format('d/m/Y') : '-' }}</td>
                                                <td style="padding: 12px; border-right: 1px solid #e0e0e0;">
                                                    <span style="background: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-family: monospace; font-weight: 600; font-size: 0.85rem;">{{ $item->placa }}</span>
                                                </td>
                                                <td style="padding: 12px; border-right: 1px solid #e0e0e0; color: #333;">{{ $item->carro }}</td>
                                                <td style="padding: 12px;">
                                                    <button type="button" class="btn buscar-placa" data-placa="{{ $item->placa }}" style="background: #ffc107; color: #000; padding: 6px 15px; border-radius: 6px; font-weight: 600; font-size: 0.8rem; border: none; transition: all 0.3s;">
                                                        Editar
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(function () {
            const formatarPlaca = function(valor) {
                const placa = (valor || '').toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 7);
                if (placa.length <= 3) return placa;
                return placa.slice(0, 3) + '-' + placa.slice(3);
            };

            const formatarPreco = function(valor) {
                const digitos = String(valor ?? '').replace(/\D/g, '');
                if (digitos === '') return '';
                const numero = (parseInt(digitos, 10) / 100).toFixed(2);
                return numero.replace('.', ',');
            };

            function mostrarMensagem(texto, tipo) {
                const $mensagem = $('#mensagem-busca');

                $mensagem
                    .removeClass('d-none alert-danger alert-success')
                    .addClass(tipo === 'erro' ? 'alert-danger' : 'alert-success')
                    .text(texto);
            }

            function preencherFormulario(carro) {
                $('#id').val(carro.id);
                $('#placa').val(formatarPlaca(carro.placa));
                $('#carro').val(carro.carro);
                $('#preco').val(formatarPreco(carro.preco));
                $('#data_servico').val(carro.data_servico);
                $('#servico').val(carro.servico);
            }

            function buscarPorPlaca(placa) {
                $.ajax({
                    url: '{{ route('carros.buscar.placa') }}',
                    type: 'GET',
                    data: { placa: placa },
                    success: function (resposta) {
                        preencherFormulario(resposta);
                        $('#buscar_placa').val(formatarPlaca(resposta.placa));
                        mostrarMensagem('Dados do serviÃ§o carregados com sucesso.', 'sucesso');
                    },
                    error: function () {
                        mostrarMensagem('ServiÃ§o nÃ£o encontrado para a placa informada.', 'erro');
                    }
                });
            }

            $('#buscar-carro').on('click', function () {
                const placa = $('#buscar_placa').val().trim();

                if (!placa) {
                    mostrarMensagem('Informe a placa para buscar o serviÃ§o.', 'erro');
                    return;
                }

                buscarPorPlaca(placa);
            });

            $('.buscar-placa').on('click', function () {
                const placa = $(this).data('placa');
                $('#buscar_placa').val(formatarPlaca(placa));
                buscarPorPlaca(placa);
            });

            $('#buscar_placa, #placa').on('input', function() {
                $(this).val(formatarPlaca($(this).val()));
            });

            $('#preco').on('input', function() {
                $(this).val(formatarPreco($(this).val()));
            });

            $('#buscar_placa').val(formatarPlaca($('#buscar_placa').val()));
            $('#placa').val(formatarPlaca($('#placa').val()));
            $('#preco').val(formatarPreco($('#preco').val()));

            $('#preco').closest('form').on('submit', function() {
                const valor = $('#preco').val();
                $('#preco').val(valor.replace('.', '').replace(',', '.'));
            });
        });
    </script>

    <style>
        /* Efeitos hover para inputs */
        input:focus, textarea:focus, select:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
            outline: none;
            background: #ffffff !important;
        }

        /* Efeitos hover para botÃµes */
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Efeito hover nas linhas da tabela */
        tbody tr:hover {
            background-color: #e8e8e8 !important;
            cursor: pointer;
        }

        /* EstilizaÃ§Ã£o do placeholder */
        ::placeholder {
            color: #999 !important;
        }

        /* Scrollbar personalizada */
        .table-responsive::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }
        
        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .table-responsive::-webkit-scrollbar-thumb {
            background: #dc3545;
            border-radius: 10px;
        }
        
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #b02a37;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            table {
                font-size: 0.8rem;
            }
            
            th, td {
                padding: 8px !important;
            }
            
            .btn {
                padding: 8px 20px !important;
                font-size: 0.85rem;
            }
        }
    </style>
</x-app-layout>
