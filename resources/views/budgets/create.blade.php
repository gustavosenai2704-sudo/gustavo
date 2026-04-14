<x-app-layout>
    <div class="oficina-shell">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="oficina-panel p-4 h-100">
                        <span class="oficina-badge mb-3">Orcamento PDF</span>
                        <h3 class="oficina-section-title mb-3">Gerar orcamento</h3>
                        <p class="oficina-text mb-4">Monte um orcamento em PDF com os dados do veiculo, do cliente e o valor estimado do servico.</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="oficina-panel p-4 p-lg-5">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('budget.pdf') }}" class="row g-4">
                            @csrf
                            <div class="col-12">
                                <label for="servico_id" class="form-label oficina-label">Servico da oficina</label>
                                <select id="servico_id" name="servico_id" class="form-select oficina-select">
                                    <option value="">Selecione um servico</option>
                                    @foreach ($servicos as $servico)
                                        <option value="{{ $servico->id }}" data-placa="{{ $servico->placa }}" data-carro="{{ $servico->carro }}" data-data-servico="{{ $servico->data_servico?->format('Y-m-d') }}" data-descricao-servico="{{ $servico->servico }}" data-valor-estimado="{{ number_format($servico->preco, 2, ',', '') }}" @selected(old('servico_id', request('servico_id')) == $servico->id)>
                                            #{{ $servico->id }} - {{ $servico->placa }} - {{ $servico->carro }} - R$ {{ number_format($servico->preco, 2, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4"><label for="placa" class="form-label oficina-label">Placa</label><input id="placa" name="placa" type="text" class="form-control oficina-input" value="{{ old('placa') }}" required></div>
                            <div class="col-md-4"><label for="carro" class="form-label oficina-label">Carro</label><input id="carro" name="carro" type="text" class="form-control oficina-input" value="{{ old('carro') }}" required></div>
                            <div class="col-md-4"><label for="data_servico" class="form-label oficina-label">Data do servico</label><input id="data_servico" name="data_servico" type="date" class="form-control oficina-input" value="{{ old('data_servico') }}"></div>
                            <div class="col-md-6"><label for="cliente_nome" class="form-label oficina-label">Nome do cliente</label><input id="cliente_nome" name="cliente_nome" type="text" class="form-control oficina-input" value="{{ old('cliente_nome') }}" required></div>
                            <div class="col-md-6"><label for="cliente_documento" class="form-label oficina-label">CPF/CNPJ</label><input id="cliente_documento" name="cliente_documento" type="text" class="form-control oficina-input" value="{{ old('cliente_documento') }}"></div>
                            <div class="col-md-6"><label for="cliente_telefone" class="form-label oficina-label">Telefone</label><input id="cliente_telefone" name="cliente_telefone" type="text" class="form-control oficina-input" value="{{ old('cliente_telefone') }}"></div>
                            <div class="col-md-6"><label for="validade" class="form-label oficina-label">Validade do orcamento</label><select id="validade" name="validade" class="form-select oficina-select" required><option value="">Selecione</option><option value="3 dias" @selected(old('validade') === '3 dias')>3 dias</option><option value="5 dias" @selected(old('validade') === '5 dias')>5 dias</option><option value="7 dias" @selected(old('validade') === '7 dias')>7 dias</option><option value="15 dias" @selected(old('validade') === '15 dias')>15 dias</option><option value="30 dias" @selected(old('validade') === '30 dias')>30 dias</option></select></div>
                            <div class="col-md-6"><label for="valor_estimado" class="form-label oficina-label">Valor estimado</label><input id="valor_estimado" name="valor_estimado" type="text" inputmode="numeric" class="form-control oficina-input" value="{{ old('valor_estimado') }}" required></div>
                            <div class="col-12"><label for="descricao_servico" class="form-label oficina-label">Descricao do servico</label><textarea id="descricao_servico" name="descricao_servico" rows="5" class="form-control oficina-input" required>{{ old('descricao_servico') }}</textarea></div>
                            <div class="col-12"><label for="observacoes" class="form-label oficina-label">Observacoes do orcamento</label><textarea id="observacoes" name="observacoes" rows="4" class="form-control oficina-input">{{ old('observacoes') }}</textarea></div>
                            <div class="col-12 d-flex justify-content-end"><button type="submit" class="btn oficina-btn-dark px-4 py-3">Gerar orcamento em PDF</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            const formatarTelefone = function(valor) { const digitos = valor.replace(/\D/g, '').slice(0, 11); if (digitos.length === 0) return ''; if (digitos.length <= 2) return '(' + digitos; if (digitos.length <= 6) return '(' + digitos.slice(0, 2) + ') ' + digitos.slice(2); if (digitos.length <= 10) return '(' + digitos.slice(0, 2) + ') ' + digitos.slice(2, 6) + '-' + digitos.slice(6); return '(' + digitos.slice(0, 2) + ') ' + digitos.slice(2, 7) + '-' + digitos.slice(7); };
            const formatarDocumento = function(valor) { const digitos = valor.replace(/\D/g, '').slice(0, 14); if (digitos.length <= 11) { if (digitos.length <= 3) return digitos; if (digitos.length <= 6) return digitos.slice(0, 3) + '.' + digitos.slice(3); if (digitos.length <= 9) return digitos.slice(0, 3) + '.' + digitos.slice(3, 6) + '.' + digitos.slice(6); return digitos.slice(0, 3) + '.' + digitos.slice(3, 6) + '.' + digitos.slice(6, 9) + '-' + digitos.slice(9); } if (digitos.length <= 2) return digitos; if (digitos.length <= 5) return digitos.slice(0, 2) + '.' + digitos.slice(2); if (digitos.length <= 8) return digitos.slice(0, 2) + '.' + digitos.slice(2, 5) + '.' + digitos.slice(5); if (digitos.length <= 12) return digitos.slice(0, 2) + '.' + digitos.slice(2, 5) + '.' + digitos.slice(5, 8) + '/' + digitos.slice(8); return digitos.slice(0, 2) + '.' + digitos.slice(2, 5) + '.' + digitos.slice(5, 8) + '/' + digitos.slice(8, 12) + '-' + digitos.slice(12); };
            const formatarPlaca = function(valor) { const placa = valor.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 7); if (placa.length <= 3) return placa; return placa.slice(0, 3) + '-' + placa.slice(3); };
            const formatarPreco = function(valor) { const digitos = valor.replace(/\D/g, ''); if (digitos === '') return ''; const numero = (parseInt(digitos, 10) / 100).toFixed(2); return numero.replace('.', ','); };
            if (telefoneInput) { telefoneInput.addEventListener('input', function(e) { e.target.value = formatarTelefone(e.target.value); }); telefoneInput.value = formatarTelefone(telefoneInput.value); }
            if (documentoInput) { documentoInput.addEventListener('input', function(e) { e.target.value = formatarDocumento(e.target.value); }); documentoInput.value = formatarDocumento(documentoInput.value); }
            if (placaInput) { placaInput.addEventListener('input', function(e) { e.target.value = formatarPlaca(e.target.value); }); placaInput.value = formatarPlaca(placaInput.value); }
            if (valorEstimadoInput) { valorEstimadoInput.addEventListener('input', function(e) { e.target.value = formatarPreco(e.target.value); }); valorEstimadoInput.form?.addEventListener('submit', function() { valorEstimadoInput.value = valorEstimadoInput.value.replace('.', '').replace(',', '.'); }); valorEstimadoInput.value = formatarPreco(valorEstimadoInput.value); }
            if (servicoSelect) { servicoSelect.addEventListener('change', function() { const opcao = servicoSelect.options[servicoSelect.selectedIndex]; if (!opcao || !opcao.value) return; if (!placaInput.value) placaInput.value = formatarPlaca(opcao.dataset.placa || ''); if (!carroInput.value) carroInput.value = opcao.dataset.carro || ''; if (!dataServicoInput.value) dataServicoInput.value = opcao.dataset.dataServico || ''; if (!descricaoServicoInput.value) descricaoServicoInput.value = opcao.dataset.descricaoServico || ''; if (!valorEstimadoInput.value) valorEstimadoInput.value = formatarPreco(opcao.dataset.valorEstimado || ''); }); if (servicoSelect.value) servicoSelect.dispatchEvent(new Event('change')); }
        });
    </script>
</x-app-layout>
