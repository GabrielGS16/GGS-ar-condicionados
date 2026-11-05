@extends('layouts.app')
@section('title', 'Detalhes do cliente')
@section('page-heading', 'Detalhes do cliente')
@section('content')
<div class="list-heading"><div><a class="back-link" href="{{ route('clientes.index') }}">← Voltar para clientes</a><h1>{{ $cliente->nome }}</h1><p>Informações e endereços cadastrados.</p></div><a class="btn btn-primary" href="{{ route('clientes.edit',$cliente) }}">Editar cliente</a></div>
<div class="content-card detail-card"><h2>Dados do cliente</h2><div class="detail-grid"><div><small>Telefone</small><strong>{{ $cliente->telefone }}</strong></div><div><small>E-mail</small><strong>{{ $cliente->email ?: '—' }}</strong></div><div><small>Cadastrado em</small><strong>{{ $cliente->created_at->format('d/m/Y') }}</strong></div></div>
<h2 class="section-spaced">Endereços</h2>
@forelse($cliente->enderecos as $endereco)<p>{{ $endereco->rua }}, {{ $endereco->numero }} — {{ $endereco->bairro }}, {{ $endereco->cidade }}/{{ $endereco->estado }}</p>@empty<p class="muted">Nenhum endereço cadastrado.</p>@endforelse
<a class="btn btn-outline" href="{{ route('enderecos.create') }}">＋ Adicionar endereço</a></div>
@endsection
