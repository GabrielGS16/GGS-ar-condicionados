<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Painel') | GGS Ar Condicionados</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script defer src="{{ asset('js/script.js') }}"></script>
</head>
<body>
<div class="app-shell">
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('dashboard') }}" class="brand">
            <span class="brand-mark">❄</span>
            <span><strong>GGS</strong><small>AR CONDICIONADOS</small></span>
        </a>
        <div class="side-label">MENU PRINCIPAL</div>
        <nav class="side-nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><span>▦</span> Visão geral</a>
            <a href="{{ route('clientes.index') }}" class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}"><span>♙</span> Clientes</a>
            <a href="{{ route('enderecos.index') }}" class="{{ request()->routeIs('enderecos.*') ? 'active' : '' }}"><span>⌖</span> Endereços</a>
            <a href="{{ route('agendamentos.index') }}" class="{{ request()->routeIs('agendamentos.*') ? 'active' : '' }}"><span>▣</span> Agendamentos</a>
            <a href="{{ route('admins.create') }}" class="{{ request()->routeIs('admins.*') ? 'active' : '' }}"><span>♙</span> Cadastrar administrador</a>
        </nav>
        <div class="sidebar-bottom">
            <div class="support-card">
                <span class="support-icon">✦</span>
                <strong>Precisa de ajuda?</strong>
                <p>Gerencie seus serviços com praticidade.</p>
            </div>
            <div class="sidebar-user">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div><strong>{{ auth()->user()->name }}</strong><small>Administrador</small></div>
                <button class="dots" type="button" aria-label="Opções da conta">•••</button>
            </div>
        </div>
    </aside>

    <main class="main-area">
        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" id="menuToggle" type="button" aria-label="Abrir menu">☰</button>
                <div><span class="eyebrow">GGS AR CONDICIONADOS</span><strong>@yield('page-heading', 'Painel de controle')</strong></div>
            </div>
            <div class="topbar-actions">
                <span class="today">{{ now()->translatedFormat('d/m/Y') }}</span>
                <div class="account-menu">
                    <button type="button" class="account-button" id="accountToggle">
                        <span class="avatar small">G</span><span>Minha conta</span><span>⌄</span>
                    </button>
                    <div class="account-dropdown" id="accountDropdown">
                        <strong>{{ auth()->user()->name }}</strong>
                        <small>{{ auth()->user()->email }}</small>
                        <a href="{{ route('dashboard') }}">Visão geral</a>
                        <form method="POST" action="{{ route('logout') }}" style="padding:8px 12px">@csrf
                            <button type="submit" style="border:0;background:none;color:#d92d3f;font:inherit;cursor:pointer">Sair do sistema</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <section class="page-content">
            @if(session('success')) <div class="alert success">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="alert error">{{ session('error') }}</div> @endif
            @if($errors->any())
                <div class="alert error validation-summary"><span class="alert-symbol">!</span><div><strong>Quase lá! Confira as informações.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></div>
            @endif
            <div id="validation-errors" data-errors='@json($errors->messages(), JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG)' hidden></div>
            @yield('content')
        </section>

        <footer class="footer">
            <span>© {{ date('Y') }} <strong>GGS Ar Condicionados</strong>. Todos os direitos reservados.</span>
            <span>Conforto e qualidade em cada ambiente <b>❄</b></span>
        </footer>
    </main>
</div>
<div class="confirm-overlay" id="confirmModal" aria-hidden="true">
    <div class="confirm-dialog" role="dialog" aria-modal="true" aria-labelledby="confirmTitle">
        <div class="confirm-icon">⌫</div><h2 id="confirmTitle">Confirmar exclusão</h2>
        <p id="confirmMessage">Tem certeza de que deseja excluir este registro?</p>
        <div class="confirm-actions"><button type="button" class="btn btn-light" id="cancelDelete">Cancelar</button><button type="button" class="btn btn-delete" id="acceptDelete">Sim, excluir</button></div>
    </div>
</div>
</body>
</html>
