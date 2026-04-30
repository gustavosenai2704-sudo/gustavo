<nav class="navbar navbar-expand-lg sticky-top"
    style="background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%); border-bottom: 3px solid #dc3545; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('carros.lista') }}">
            <div class="oficina-logo"
                style="background: #dc3545; padding: 8px; border-radius: 12px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                <x-application-logo class="w-100 h-100" style="filter: brightness(0) invert(1);" />
            </div>
            <span>
                <small class="d-block text-uppercase"
                    style="color: #ffc107; font-size: 0.7rem; letter-spacing: 2px;">Oficina Especializada</small>
                <strong class="d-block" style="color: #ffffff; font-size: 1.3rem; font-weight: 700;">Ary Balanceamento</strong>
            </span>
        </a>

        <div class="navbar-links-wrapper" id="oficinaNav">
            @php
                $navLinks = [
                    ['route' => 'carros.lista', 'active' => 'carros.lista', 'label' => 'Historico'],
                    ['route' => 'carros.salvar.form', 'active' => 'carros.salvar.form', 'label' => 'Cadastrar'],
                    ['route' => 'carros.alterar.form', 'active' => 'carros.alterar.form', 'label' => 'Alterar'],
                    ['route' => 'carros.deletar.form', 'active' => 'carros.deletar.form', 'label' => 'Deletar'],
                    ['route' => 'invoice.create', 'active' => 'invoice.create', 'label' => 'NFS-e / Fatura'],
                    ['route' => 'budget.create', 'active' => 'budget.create', 'label' => 'Orcamentos'],
                ];
            @endphp

            <ul class="navbar-nav mx-auto mb-3 mb-lg-0 gap-2">
                @foreach ($navLinks as $link)
                    <li class="nav-item">
                        <a class="nav-link nav-button {{ request()->routeIs($link['active']) ? 'active' : '' }}"
                            href="{{ route($link['route']) }}">
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            @auth
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center gap-2" type="button"
                        data-bs-toggle="dropdown"
                        style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #ffffff; border: none; padding: 8px 20px; border-radius: 25px; font-weight: 500;">
                        <span>{{ Auth::user()->name }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end"
                        style="background: #1a1a1a; border: 1px solid #dc3545; border-radius: 12px; margin-top: 10px;">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}"
                                style="color: #ffc107; padding: 10px 20px; border-radius: 8px;">Perfil</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" style="border-color: #dc3545;">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"
                                    style="color: #ffc107; padding: 10px 20px; border-radius: 8px;">Sair</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>

<style>
    .nav-button {
        color: #ffffff !important;
        font-weight: 600;
        padding: 8px 18px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.08);
        transition: all 0.3s;
        white-space: nowrap;
    }

    .navbar-links-wrapper {
        display: flex;
        align-items: center;
        flex: 1;
        gap: 16px;
    }

    .nav-link:hover {
        background-color: #dc3545 !important;
        color: #ffffff !important;
        transform: translateY(-2px);
    }

    .nav-link.active {
        background: linear-gradient(135deg, #dc3545, #b02a37) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
    }

    .dropdown-item:hover {
        background-color: #dc3545 !important;
        color: #ffffff !important;
        transform: translateX(5px);
    }

    .dropdown-menu {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    }

    @media (max-width: 1199px) {
        .navbar .container {
            align-items: flex-start;
            flex-direction: column;
            gap: 16px;
        }

        .navbar-links-wrapper {
            align-items: stretch;
            flex-direction: column;
            width: 100%;
        }

        .navbar-nav {
            margin-top: 15px;
            width: 100%;
        }

        .nav-link {
            text-align: center;
            margin: 5px 0;
        }
    }
</style>
