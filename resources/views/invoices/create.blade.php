<x-app-layout>
    <div class="oficina-shell">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="oficina-panel p-4 h-100">
                        <span class="oficina-badge mb-3">Fatura PDF</span>
                        <h3 class="oficina-section-title mb-3">Gerar documento</h3>
                        <p class="oficina-text mb-4">Selecione um servico para montar uma fatura em PDF com os dados da oficina e do atendimento.</p>
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
                        <form method="POST" action="{{ route('invoice.pdf') }}" class="row g-4">
                            @csrf
                            <div class="col-12">
                                <label for="servico_id" class="form-label oficina-label">Servico da oficina</label>
                                <select id="servico_id" name="servico_id" class="form-select oficina-select">
                                    <option value="">Selecione um servico</option>
                                    @foreach ($servicos as $servico)
                                        <option value="{{ $servico->id }}" @selected(old('servico_id') == $servico->id)>
                                            #{{ $servico->id }} - {{ $servico->placa }} - {{ $servico->carro }} - R$ {{ number_format($servico->preco, 2, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="cliente_nome" class="form-label oficina-label">Nome do cliente</label>
                                <input id="cliente_nome" name="cliente_nome" type="text" class="form-control oficina-input" value="{{ old('cliente_nome') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cliente_documento" class="form-label oficina-label">CPF/CNPJ</label>
                                <input id="cliente_documento" name="cliente_documento" type="text" class="form-control oficina-input" value="{{ old('cliente_documento') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="cliente_telefone" class="form-label oficina-label">Telefone</label>
                                <input id="cliente_telefone" name="cliente_telefone" type="text" class="form-control oficina-input" value="{{ old('cliente_telefone') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="forma_pagamento" class="form-label oficina-label">Forma de pagamento</label>
                                <select id="forma_pagamento" name="forma_pagamento" class="form-select oficina-select" required>
                                    <option value="">Selecione</option>
                                    <option value="Dinheiro" @selected(old('forma_pagamento') === 'Dinheiro')>Dinheiro</option>
                                    <option value="Pix" @selected(old('forma_pagamento') === 'Pix')>Pix</option>
                                    <option value="Cartao de debito" @selected(old('forma_pagamento') === 'Cartao de debito')>Cartao de debito</option>
                                    <option value="Cartao de credito" @selected(old('forma_pagamento') === 'Cartao de credito')>Cartao de credito</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="observacoes" class="form-label oficina-label">Observacoes da fatura</label>
                                <textarea id="observacoes" name="observacoes" rows="4" class="form-control oficina-input">{{ old('observacoes') }}</textarea>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn oficina-btn-dark px-4 py-3">Gerar fatura em PDF</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const telefoneInput = document.getElementById('cliente_telefone');
            const documentoInput = document.getElementById('cliente_documento');
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
            if (telefoneInput) {
                telefoneInput.addEventListener('input', function(e) { e.target.value = formatarTelefone(e.target.value); });
                telefoneInput.value = formatarTelefone(telefoneInput.value);
            }
            if (documentoInput) {
                documentoInput.addEventListener('input', function(e) { e.target.value = formatarDocumento(e.target.value); });
                documentoInput.value = formatarDocumento(documentoInput.value);
            }
        });
    </script>
</x-app-layout>
