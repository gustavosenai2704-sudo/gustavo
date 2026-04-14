<x-app-layout>
    <div style="background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%); min-height: 100vh; padding: 40px 0;">
        <div class="container">
            <div class="d-flex flex-wrap gap-3 justify-content-center mb-5">
                <a href="{{ route('carros.salvar.form') }}" class="btn"
                    style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #fff; padding: 12px 30px; border-radius: 30px; font-weight: 600; transition: all 0.3s;">
                    Cadastrar
                </a>
                <a href="{{ route('invoice.create') }}" class="btn"
                    style="background: transparent; color: #ffffff; padding: 12px 30px; border-radius: 30px; font-weight: 600; border: 2px solid #ffffff; transition: all 0.3s;">
                    NFS-e / Fatura
                </a>
                <a href="{{ route('carros.lista') }}" class="btn"
                    style="background: transparent; color: #ffc107; padding: 12px 30px; border-radius: 30px; font-weight: 600; border: 2px solid #ffc107; transition: all 0.3s;">
                    Historico
                </a>
                <a href="{{ route('carros.alterar.form') }}" class="btn"
                    style="background: transparent; color: #ffc107; padding: 12px 30px; border-radius: 30px; font-weight: 600; border: 2px solid #ffc107; transition: all 0.3s;">
                    Alterar
                </a>
                <a href="{{ route('carros.deletar.form') }}" class="btn"
                    style="background: transparent; color: #dc3545; padding: 12px 30px; border-radius: 30px; font-weight: 600; border: 2px solid #dc3545; transition: all 0.3s;">
                    Deletar
                </a>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div
                        style="background: linear-gradient(135deg, #1a1a1a, #0d0d0d); border-radius: 20px; padding: 30px; border-left: 5px solid #dc3545; height: 100%; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                        <div
                            style="background: rgba(220, 53, 69, 0.1); display: inline-block; padding: 8px 20px; border-radius: 30px; margin-bottom: 20px;">
                            <span style="color: #ffc107; font-weight: 600;">Nova ordem</span>
                        </div>
                        <h3 style="color: #dc3545; margin-bottom: 20px; font-weight: 700;">Entrada de servico</h3>
                        <p style="color: #ccc; line-height: 1.6; margin-bottom: 30px;">
                            Registre placa, modelo do carro, valor cobrado, data e o servico executado no atendimento.
                        </p>

                        <div
                            style="background: #000000; border-radius: 15px; padding: 20px; border: 1px solid rgba(220, 53, 69, 0.3);">
                            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                                <span style="font-size: 24px;">+</span>
                                <span style="color: #ffc107; font-weight: 600;">Atendimento rapido</span>
                            </div>
                            <div style="font-size: 28px; color: #dc3545; font-weight: 700; margin-bottom: 10px;">
                                {{ now()->format('d/m/Y') }}
                            </div>
                            <p style="color: #999; margin: 0;">Sistema pronto para receber novos servicos</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div
                        style="background: linear-gradient(135deg, #1a1a1a, #0d0d0d); border-radius: 20px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                        @if (session('success'))
                            <div
                                style="background: linear-gradient(135deg, #ffc107, #ff9800); color: #000; padding: 15px 20px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid #dc3545; font-weight: 500;">
                                {{ session('success') }}
                            </div>

                            @if (session('servico_novo_id'))
                                <div
                                    style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.12); color: #fff; padding: 18px 20px; border-radius: 12px; margin-bottom: 30px;">
                                    <div style="font-size: 0.85rem; color: #ffc107; margin-bottom: 8px;">NFS-e do servico recem-cadastrado</div>
                                    <div style="margin-bottom: 14px;">Servico #{{ session('servico_novo_id') }} da placa {{ session('servico_novo_placa') }} pronto para emissao.</div>
                                    <a href="{{ route('emitir.nfse', session('servico_novo_id')) }}" class="btn"
                                        style="background: linear-gradient(135deg, #f8f9fa, #d9d9d9); color: #111; padding: 10px 22px; border-radius: 999px; font-weight: 700;">
                                        Emitir NFS-e agora
                                    </a>
                                </div>
                            @endif
                        @endif

                        <form method="POST" action="{{ route('carros.store') }}" class="row g-4">
                            @csrf

                            <div class="col-md-6">
                                <label for="placa" class="form-label"
                                    style="color: #ffc107; font-weight: 600; margin-bottom: 8px;">
                                    Placa do Veiculo
                                </label>
                                <input id="placa" name="placa" type="text"
                                    class="form-control @error('placa') is-invalid @enderror"
                                    style="background: #000000; color: #fff; border: 2px solid rgba(220, 53, 69, 0.3); border-radius: 12px; padding: 12px 15px; transition: all 0.3s;"
                                    value="{{ old('placa') }}" required placeholder="ABC-1234">
                                @error('placa')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="carro" class="form-label"
                                    style="color: #ffc107; font-weight: 600; margin-bottom: 8px;">
                                    Modelo do carro
                                </label>
                                <input id="carro" name="carro" type="text"
                                    class="form-control @error('carro') is-invalid @enderror"
                                    style="background: #000000; color: #fff; border: 2px solid rgba(220, 53, 69, 0.3); border-radius: 12px; padding: 12px 15px; transition: all 0.3s;"
                                    value="{{ old('carro') }}" required placeholder="Ex: Honda Civic">
                                @error('carro')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="preco" class="form-label"
                                    style="color: #ffc107; font-weight: 600; margin-bottom: 8px;">
                                    Valor do servico
                                </label>
                                <input id="preco" name="preco" type="number" step="0.01"
                                    class="form-control @error('preco') is-invalid @enderror"
                                    style="background: #000000; color: #fff; border: 2px solid rgba(220, 53, 69, 0.3); border-radius: 12px; padding: 12px 15px; transition: all 0.3s;"
                                    value="{{ old('preco') }}" required placeholder="R$ 0,00">
                                @error('preco')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_servico" class="form-label"
                                    style="color: #ffc107; font-weight: 600; margin-bottom: 8px;">
                                    Data do servico
                                </label>
                                <input id="data_servico" name="data_servico" type="date"
                                    class="form-control @error('data_servico') is-invalid @enderror"
                                    style="background: #000000; color: #fff; border: 2px solid rgba(220, 53, 69, 0.3); border-radius: 12px; padding: 12px 15px; transition: all 0.3s;"
                                    value="{{ old('data_servico') }}" required>
                                @error('data_servico')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="servico" class="form-label"
                                    style="color: #ffc107; font-weight: 600; margin-bottom: 8px;">
                                    Servico realizado
                                </label>
                                <textarea id="servico" name="servico" class="form-control @error('servico') is-invalid @enderror" rows="5"
                                    style="background: #000000; color: #fff; border: 2px solid rgba(220, 53, 69, 0.3); border-radius: 12px; padding: 12px 15px; transition: all 0.3s; resize: vertical;"
                                    required placeholder="Descreva detalhadamente o servico executado...">{{ old('servico') }}</textarea>
                                @error('servico')
                                    <div class="invalid-feedback d-block" style="color: #dc3545;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn"
                                    style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #fff; padding: 14px 40px; border-radius: 40px; font-weight: 700; font-size: 16px; transition: all 0.3s; width: auto;">
                                    Salvar servico
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.nfse-cliente-modal')
</x-app-layout>

<style>
    input:focus,
    textarea:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2) !important;
        outline: none;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    ::placeholder {
        color: #666 !important;
    }

    div[style*="border-left: 5px solid #dc3545"]:hover,
    div[style*="border-radius: 20px"]:hover {
        transform: translateY(-5px);
        transition: all 0.3s;
    }
</style>
