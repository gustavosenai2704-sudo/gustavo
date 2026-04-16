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

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#oficinaNav"
            style="background-color: #dc3545; border: none; padding: 8px 12px;">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>

        <div class="collapse navbar-collapse" id="oficinaNav">
            <ul class="navbar-nav mx-auto mb-3 mb-lg-0 gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('carros.lista') ? 'active' : '' }}"
                        href="{{ route('carros.lista') }}"
                        style="color: #ffffff; font-weight: 500; padding: 8px 20px; border-radius: 25px; transition: all 0.3s;">
                        📋 Histórico
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('carros.salvar.form') ? 'active' : '' }}"
                        href="{{ route('carros.salvar.form') }}"
                        style="color: #ffffff; font-weight: 500; padding: 8px 20px; border-radius: 25px; transition: all 0.3s;">
                        ➕ Cadastrar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('carros.alterar.form') ? 'active' : '' }}"
                        href="{{ route('carros.alterar.form') }}"
                        style="color: #ffffff; font-weight: 500; padding: 8px 20px; border-radius: 25px; transition: all 0.3s;">
                        ✏️ Alterar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('carros.deletar.form') ? 'active' : '' }}"
                        href="{{ route('carros.deletar.form') }}"
                        style="color: #ffffff; font-weight: 500; padding: 8px 20px; border-radius: 25px; transition: all 0.3s;">
                        🗑️ Deletar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('invoice.create') ? 'active' : '' }}"
                        href="{{ route('invoice.create') }}"
                        style="color: #ffffff; font-weight: 500; padding: 8px 20px; border-radius: 25px; transition: all 0.3s;">
                        NFS-e / Fatura
                    </a>
                </li>
            </ul>

            @auth
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center gap-2" type="button"
                        data-bs-toggle="dropdown"
                        style="background: linear-gradient(135deg, #dc3545, #b02a37); color: #ffffff; border: none; padding: 8px 20px; border-radius: 25px; font-weight: 500;">
                        <span>👤</span>
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end"
                        style="background: #1a1a1a; border: 1px solid #dc3545; border-radius: 12px; margin-top: 10px;">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"
                                style="color: #ffc107; padding: 10px 20px; border-radius: 8px;">⚙️ Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider" style="border-color: #dc3545;">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"
                                    style="color: #ffc107; padding: 10px 20px; border-radius: 8px;">🚪 Sair</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>

<style>
    /* Efeitos hover navbar */
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

    /* Efeitos dropdown */
    .dropdown-item:hover {
        background-color: #dc3545 !important;
        color: #ffffff !important;
        transform: translateX(5px);
    }

    .dropdown-menu {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    }

    /* Botão toggler responsivo */
    @media (max-width: 991px) {
        .navbar-nav {
            margin-top: 15px;
        }

        .nav-link {
            text-align: center;
            margin: 5px 0;
        }
    }
</style>
