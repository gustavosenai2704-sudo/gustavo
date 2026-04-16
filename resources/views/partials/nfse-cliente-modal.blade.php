@if ($errors->has('nfse_cliente'))
    <div class="container mb-3">
        <div class="alert alert-danger">
            {{ $errors->first('nfse_cliente') }}
        </div>
    </div>
@endif

<div id="nfse-modal-overlay"
    style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.55); z-index: 9999; padding: 20px; align-items: center; justify-content: center;">
    <div style="background: #fff; width: 100%; max-width: 580px; border-radius: 12px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.25);">
        <div style="padding: 22px 24px; border-bottom: 1px solid #e5e5e5; background: #f8f9fa;">
            <div style="font-size: 0.8rem; color: #666; font-weight: 700;">NFS-E</div>
            <h3 style="margin: 8px 0 0; color: #333; font-size: 1.25rem; font-weight: 700;">Completar dados do tomador</h3>
            <p id="nfse-modal-subtitulo" style="margin: 10px 0 0; color: #666;">Preencha os dados do cliente para emitir a NFS-e.</p>
        </div>
        <form id="nfse-modal-form" method="POST" action="" style="padding: 24px;">
            @csrf
            <div class="mb-3">
                <label for="nfse_nome_cliente" class="form-label">Nome do cliente</label>
                <input id="nfse_nome_cliente" name="nome_cliente" type="text" class="form-control" value="{{ old('nome_cliente', session('nfse_modal.nome_cliente')) }}" required>
            </div>
            <div class="mb-3">
                <label for="nfse_cpf_cliente" class="form-label">CPF/CNPJ</label>
                <input id="nfse_cpf_cliente" name="cpf_cliente" type="text" inputmode="numeric" class="form-control" value="{{ old('cpf_cliente', session('nfse_modal.cpf_cliente')) }}" required>
            </div>
            <div class="mb-4">
                <label for="nfse_endereco_cliente" class="form-label">Endereco do cliente</label>
                <input id="nfse_endereco_cliente" name="endereco_cliente" type="text" class="form-control" value="{{ old('endereco_cliente', session('nfse_modal.endereco_cliente')) }}" required>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button type="button" id="nfse-modal-cancelar" class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn btn-dark">Salvar e emitir NFS-e</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modalOverlay = document.getElementById('nfse-modal-overlay');
    const modalForm = document.getElementById('nfse-modal-form');
    const modalSubtitulo = document.getElementById('nfse-modal-subtitulo');
    const cancelarModal = document.getElementById('nfse-modal-cancelar');
    const nomeInput = document.getElementById('nfse_nome_cliente');
    const cpfInput = document.getElementById('nfse_cpf_cliente');
    const enderecoInput = document.getElementById('nfse_endereco_cliente');
    if (!modalOverlay || !modalForm || !nomeInput || !cpfInput || !enderecoInput) return;
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
    const abrirModal = function(dados) {
        modalForm.action = dados.formAction;
        nomeInput.value = dados.nomeCliente || '';
        cpfInput.value = formatarDocumento(dados.cpfCliente || '');
        enderecoInput.value = dados.enderecoCliente || '';
        modalSubtitulo.textContent = 'Servico #' + dados.carroId + ' - ' + (dados.placa || 'sem placa') + ' - ' + (dados.carroModelo || 'veiculo');
        modalOverlay.style.display = 'flex';
    };
    document.querySelectorAll('.abrir-modal-nfse').forEach(function(botao) {
        botao.addEventListener('click', function() {
            abrirModal({
                carroId: botao.dataset.carroId,
                placa: botao.dataset.placa,
                carroModelo: botao.dataset.carroModelo,
                nomeCliente: botao.dataset.nomeCliente,
                cpfCliente: botao.dataset.cpfCliente,
                enderecoCliente: botao.dataset.enderecoCliente,
                formAction: botao.dataset.formAction,
            });
        });
    });
    cancelarModal.addEventListener('click', function() { modalOverlay.style.display = 'none'; });
    cpfInput.addEventListener('input', function(e) { e.target.value = formatarDocumento(e.target.value); });
    @if (session('nfse_modal'))
    abrirModal({
        carroId: @json(session('nfse_modal.carro_id')),
        placa: @json(session('nfse_modal.placa')),
        carroModelo: @json(session('nfse_modal.carro')),
        nomeCliente: @json(session('nfse_modal.nome_cliente')),
        cpfCliente: @json(session('nfse_modal.cpf_cliente')),
        enderecoCliente: @json(session('nfse_modal.endereco_cliente')),
        formAction: @json(route('emitir.nfse.cliente', session('nfse_modal.carro_id'))),
    });
    @endif
});
</script>
