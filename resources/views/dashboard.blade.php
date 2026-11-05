@extends('layouts.app')
@section('title', 'Visão geral')
@section('page-heading', 'Visão geral')
@section('content')
<div class="welcome-row">
    <div><span class="eyebrow blue">BEM-VINDO AO SEU PAINEL</span><h1>Olá, equipe GGS! 👋</h1><p>Acompanhe os clientes e os serviços da sua empresa.</p></div>
    <a class="btn btn-primary" href="{{ route('agendamentos.create') }}">＋ Novo agendamento</a>
</div>
<div class="stats-grid">
    <article class="stat-card"><div class="stat-top"><span>Total de clientes</span><span class="stat-icon blue-bg">♙</span></div><strong>{{ $totalClientes }}</strong><small>Clientes cadastrados</small></article>
    <article class="stat-card"><div class="stat-top"><span>Agendamentos</span><span class="stat-icon red-bg">▣</span></div><strong>{{ $totalAgendamentos }}</strong><small>Registros no sistema</small></article>
    <article class="stat-card"><div class="stat-top"><span>Pendentes</span><span class="stat-icon orange-bg">◷</span></div><strong>{{ $pendentes }}</strong><small>Aguardando atendimento</small></article>
    <article class="stat-card"><div class="stat-top"><span>Concluídos</span><span class="stat-icon green-bg">✓</span></div><strong>{{ $concluidos }}</strong><small>Serviços finalizados</small></article>
</div>
<div class="content-card">
    <div class="card-heading"><div><h2>Agendamentos recentes</h2><p>Veja os últimos serviços registrados.</p></div><a class="text-link" href="{{ route('agendamentos.index') }}">Ver todos →</a></div>
    <div class="table-wrap"><table><thead><tr><th>CLIENTE</th><th>SERVIÇO</th><th>DATA</th><th>STATUS</th><th></th></tr></thead><tbody>
    @forelse($ultimosAgendamentos as $item)
        <tr><td><strong>{{ $item->cliente->nome }}</strong><small class="table-sub">{{ $item->cliente->telefone }}</small></td><td>{{ $item->servico->nome }}</td><td>{{ $item->data->format('d/m/Y') }}<small class="table-sub">{{ substr($item->horario, 0, 5) }}</small></td><td><span class="status status-{{ \Illuminate\Support\Str::slug($item->status) }}">{{ $item->status }}</span></td><td><a class="icon-link" href="{{ route('agendamentos.show', $item) }}">↗</a></td></tr>
    @empty
        <tr><td colspan="5" class="empty">Nenhum agendamento cadastrado ainda.</td></tr>
    @endforelse
    </tbody></table></div>
</div>
<div class="quick-grid">
    <a class="quick-card" href="{{ route('clientes.create') }}"><span class="quick-icon">♙</span><span><strong>Cadastrar cliente</strong><small>Adicione um novo cliente</small></span><b>→</b></a>
    <a class="quick-card" href="{{ route('enderecos.create') }}"><span class="quick-icon">⌖</span><span><strong>Cadastrar endereço</strong><small>Registre um local de atendimento</small></span><b>→</b></a>
    <a class="quick-card" href="{{ route('agendamentos.create') }}"><span class="quick-icon red-bg">▣</span><span><strong>Novo agendamento</strong><small>Marque uma instalação ou manutenção</small></span><b>→</b></a>
</div>
@endsection
