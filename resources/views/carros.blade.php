<x-app-layout>
    <x-slot name="header">
        <p class="oficina-subtitle">Central da Oficina</p>
        <h2 class="oficina-title">Gestao de Servicos</h2>
    </x-slot>

    <div class="oficina-shell">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="oficina-panel p-4 h-100">
                        <span class="oficina-badge mb-3">Bem-vindo</span>
                        <h3 class="oficina-section-title mb-3">Ary Auto Center</h3>
                        <p class="oficina-text mb-0">Use este painel para cadastrar, consultar, alterar e excluir os servicos realizados na oficina.</p>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="oficina-panel p-4 p-lg-5 h-100">
                        <h3 class="oficina-section-title mb-4">Acesso rapido</h3>
                        <p class="oficina-text mb-0">Navegue pelas opcoes do sistema usando o menu principal no topo da pagina.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
