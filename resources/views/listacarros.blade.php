<x-app-layout>
    <div style="background: linear-gradient(135deg, #e8e8e8 0%, #d4d4d4 100%); min-height: 100vh; padding: 40px 0;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <div
                        style="background: #ffffff; border-radius: 12px; padding: 25px; border-top: 4px solid #dc3545; box-shadow: 0 5px 15px rgba(0,0,0,0.1); height: 100%;">
                        <div
                            style="background: #f8f9fa; display: inline-block; padding: 6px 15px; border-radius: 5px; margin-bottom: 20px;">
                            <span style="color: #dc3545; font-weight: 600; font-size: 0.85rem;">FILTRO</span>
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-weight: 600; font-size: 1.3rem;">Ordenar historico</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 25px; font-size: 0.9rem;">
                            Escolha a ordem de exibicao dos servicos realizados.
                        </p>

                        <form method="GET" action="{{ route('carros.lista') }}">
                            <div class="mb-4">
                                <label for="ordem" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    Ordenacao
                                </label>
                                <select id="ordem" name="ordem" class="form-select"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #ddd; border-radius: 8px; padding: 10px; cursor: pointer;">
                                    <option value="recentes" @selected($ordem === 'recentes')>Mais recentes</option>
                                    <option value="antigos" @selected($ordem === 'antigos')>Mais antigos</option>
                                </select>
                            </div>

                            <div>
                                <button type="submit" class="btn w-100 py-2"
                                    style="background: #dc3545; color: #fff; border-radius: 8px; font-weight: 600; transition: all 0.3s;">
                                    Aplicar filtro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div
                        style="background: #ffffff; border-radius: 12px; padding: 25px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
                            <div>
                                <div
                                    style="background: #f8f9fa; display: inline-block; padding: 5px 12px; border-radius: 5px; margin-bottom: 10px;">
                                    <span style="color: #dc3545; font-size: 0.8rem; font-weight: 600;">RESULTADOS</span>
                                </div>
                                <h3 style="color: #333; margin: 0; font-weight: 600; font-size: 1.2rem;">Todos os servicos realizados</h3>
                            </div>
                            <div
                                style="background: #f8f9fa; border-radius: 8px; padding: 10px 20px; text-align: center;">
                                <span class="d-block mb-1" style="color: #666; font-size: 0.8rem;">Total de registros</span>
                                <strong
                                    style="color: #dc3545; font-size: 1.8rem; font-weight: 700;">{{ $carros->count() }}</strong>
                            </div>
                        </div>

                        @if ($carros->isEmpty())
                            <div
                                style="text-align: center; padding: 60px 20px; background: #f8f9fa; border-radius: 8px; border: 2px dashed #dee2e6;">
                                <p style="color: #666; font-size: 1.1rem;">Nenhum servico cadastrado ainda.</p>
                                <a href="{{ route('carros.salvar.form') }}" class="btn mt-3"
                                    style="background: #dc3545; color: #fff; padding: 10px 25px; border-radius: 8px;">
                                    Cadastrar primeiro servico
                                </a>
                            </div>
                        @else
                            <div class="table-responsive" style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                                    <thead>
                                        <tr
                                            style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #ffffff;">
                                            <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">ID</th>
                                            <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">Data</th>
                                            <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">Garantia</th>
                                            <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">Status</th>
                                            <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">Placa</th>
                                            <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">Carro</th>
                                            <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">Preco</th>
                                            <th style="padding: 15px 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">NFS-e</th>
                                            <th style="padding: 15px 12px; text-align: left; font-weight: 600;">Servico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carros as $index => $item)
                                            <tr
                                                style="border-bottom: 1px solid #e0e0e0; background-color: {{ $index % 2 == 0 ? '#ffffff' : '#f8f9fa' }}; transition: all 0.3s;">
                                                <td style="padding: 15px 12px; border-right: 1px solid #e0e0e0; color: #333; font-weight: 500;">#{{ $item->id }}</td>
                                                <td style="padding: 15px 12px; border-right: 1px solid #e0e0e0; color: #555;">{{ $item->data_servico->format('d/m/Y') }}</td>
                                                <td style="padding: 15px 12px; border-right: 1px solid #e0e0e0; color: #555;">{{ $item->garantia_fim->format('d/m/Y') }}</td>
                                                <td style="padding: 15px 12px; border-right: 1px solid #e0e0e0;">
                                                    @if ($item->garantia_expirada)
                                                        <span
                                                            style="background: #f8d7da; color: #721c24; padding: 4px 12px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">Expirado</span>
                                                    @else
                                                        <span
                                                            style="background: #d4edda; color: #155724; padding: 4px 12px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">Ativa</span>
                                                    @endif
                                                </td>
                                                <td style="padding: 15px 12px; border-right: 1px solid #e0e0e0;">
                                                    <span
                                                        style="background: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-family: monospace; font-weight: 600; font-size: 0.85rem;">{{ $item->placa }}</span>
                                                </td>
                                                <td style="padding: 15px 12px; border-right: 1px solid #e0e0e0; color: #333; font-weight: 500;">{{ $item->carro }}</td>
                                                <td style="padding: 15px 12px; border-right: 1px solid #e0e0e0; color: #28a745; font-weight: 700; font-size: 1rem;">R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
                                                <td style="padding: 15px 12px; border-right: 1px solid #e0e0e0;">
                                                    <a href="{{ route('emitir.nfse', $item->id) }}"
                                                        class="btn"
                                                        style="background: {{ $item->numero_nf ? '#198754' : '#212529' }}; color: #fff; padding: 8px 12px; border-radius: 6px; font-weight: 600; font-size: 0.8rem; white-space: nowrap;">
                                                        {{ $item->numero_nf ? 'Reemitir NFS-e' : 'Emitir NFS-e' }}
                                                    </a>
                                                    @if ($item->numero_nf)
                                                        <div style="margin-top: 6px; font-size: 0.75rem; color: #666;">
                                                            {{ $item->numero_nf }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td style="padding: 15px 12px; color: #555; max-width: 300px;">
                                                    <div style="max-height: 60px; overflow-y: auto; word-wrap: break-word;">
                                                        {{ $item->servico }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if (method_exists($carros, 'links'))
                                <div class="mt-4 d-flex justify-content-center">
                                    {{ $carros->links() }}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.nfse-cliente-modal')

    <style>
        .table-responsive tbody tr:hover {
            background-color: #e8e8e8 !important;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

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

        tbody tr {
            animation: fadeInUp 0.3s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        select:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
            outline: none;
        }

        @media (max-width: 768px) {
            table {
                font-size: 0.8rem;
            }

            th,
            td {
                padding: 10px 8px !important;
            }

            .btn {
                padding: 8px 20px !important;
                font-size: 0.85rem;
            }
        }

        td div::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        td div::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        td div::-webkit-scrollbar-thumb {
            background: #dc3545;
            border-radius: 5px;
        }
    </style>
</x-app-layout>
