<x-app-layout>
    <div style="background: linear-gradient(135deg, #e8e8e8 0%, #d4d4d4 100%); min-height: 100vh; padding: 40px 0;">
        <div class="container">
            <div class="row g-4">
                <!-- FormulÃ¡rio de exclusÃ£o -->
                <div class="col-lg-5">
                    <div
                        style="background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); height: 100%; border-top: 4px solid #dc3545;">
                        @if (session('success'))
                            <div
                                style="background: #d4edda; color: #155724; padding: 15px 20px; border-radius: 8px; margin-bottom: 30px; border-left: 4px solid #28a745; font-weight: 500;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div
                                style="background: #f8d7da; color: #721c24; padding: 15px 20px; border-radius: 8px; margin-bottom: 30px; border-left: 4px solid #dc3545; font-weight: 500;">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div
                            style="background: #f8f9fa; display: inline-block; padding: 5px 12px; border-radius: 5px; margin-bottom: 15px;">
                            <span style="color: #dc3545; font-weight: 600; font-size: 0.8rem;">ATENÃ‡ÃƒO</span>
                        </div>
                        <h3 style="color: #333; margin-bottom: 15px; font-weight: 700; font-size: 1.5rem;">Excluir
                            registro</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 25px;">
                            Use o ID do serviÃ§o para remover o registro do histÃ³rico da oficina. Esta aÃ§Ã£o Ã©
                            irreversÃ­vel.
                        </p>

                        <form method="POST" action="{{ route('carros.destroy') }}" class="row g-4">
                            @csrf
                            @method('DELETE')

                            <div class="col-12">
                                <label for="id" class="form-label"
                                    style="color: #333; font-weight: 600; margin-bottom: 8px;">
                                    ID do serviÃ§o
                                </label>
                                <input id="id" name="id" type="number"
                                    class="form-control @error('id') is-invalid @enderror"
                                    style="background: #f8f9fa; color: #333; border: 1px solid #dee2e6; border-radius: 8px; padding: 12px 15px;"
                                    value="{{ old('id') }}" required placeholder="Digite o ID do serviÃ§o">
                                @error('id')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn"
                                    style="background: #dc3545; color: #fff; padding: 12px 35px; border-radius: 8px; font-weight: 700; font-size: 16px; transition: all 0.3s;">
                                    Deletar serviÃ§o
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Lista de serviÃ§os cadastrados -->
                <div class="col-lg-7">
                    <div
                        style="background: #ffffff; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); height: 100%;">
                        <div
                            style="background: #f8f9fa; display: inline-block; padding: 5px 12px; border-radius: 5px; margin-bottom: 15px;">
                            <span style="color: #dc3545; font-size: 0.8rem; font-weight: 600;">CONSULTA</span>
                        </div>
                        <h3 style="color: #333; margin-bottom: 20px; font-weight: 600; font-size: 1.2rem;">ServiÃ§os
                            cadastrados</h3>

                        @if ($carros->isEmpty())
                            <div
                                style="text-align: center; padding: 60px 20px; background: #f8f9fa; border-radius: 8px; border: 2px dashed #dee2e6;">
                                <p style="color: #666; font-size: 1rem; margin: 0;">Nenhum serviÃ§o cadastrado.</p>
                            </div>
                        @else
                            <div class="table-responsive" style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                                    <thead>
                                        <tr
                                            style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #ffffff;">
                                            <th
                                                style="padding: 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">
                                                ID</th>
                                            <th
                                                style="padding: 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">
                                                Data</th>
                                            <th
                                                style="padding: 12px; text-align: left; font-weight: 600; border-right: 1px solid rgba(255,255,255,0.2);">
                                                Placa</th>
                                            <th style="padding: 12px; text-align: left; font-weight: 600;">Carro</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carros as $index => $item)
                                            <tr style="border-bottom: 1px solid #e0e0e0; background-color: {{ $index % 2 == 0 ? '#ffffff' : '#f8f9fa' }}; transition: all 0.3s; cursor: pointer;"
                                                onclick="$('#id').val({{ $item->id }});">
                                                <td
                                                    style="padding: 12px; border-right: 1px solid #e0e0e0; color: #333; font-weight: 500;">
                                                    #{{ $item->id }}</td>
                                                <td
                                                    style="padding: 12px; border-right: 1px solid #e0e0e0; color: #555;">
                                                    {{ $item->data_servico ? \Carbon\Carbon::parse($item->data_servico)->format('d/m/Y') : '-' }}
                                                </td>
                                                <td style="padding: 12px; border-right: 1px solid #e0e0e0;">
                                                    <span
                                                        style="background: #fff3cd; color: #856404; padding: 4px 8px; border-radius: 4px; font-family: monospace; font-weight: 600; font-size: 0.85rem;">{{ $item->placa }}</span>
                                                </td>
                                                <td style="padding: 12px; color: #333;">{{ $item->carro }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div
                                style="margin-top: 15px; padding: 10px; background: #f8f9fa; border-radius: 8px; text-align: center;">
                                <small style="color: #666;">ðŸ’¡ Clique em qualquer linha para preencher o ID
                                    automaticamente</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Efeitos hover para inputs */
        input:focus {
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

        /* AnimaÃ§Ã£o de entrada */
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

        /* Responsividade */
        @media (max-width: 768px) {
            table {
                font-size: 0.8rem;
            }

            th,
            td {
                padding: 8px !important;
            }

            .btn {
                padding: 8px 20px !important;
                font-size: 0.85rem;
            }
        }
    </style>
</x-app-layout>
