@extends('layouts.app')
@section('title', 'Detalhes do agendamento')
@section('page-heading', 'Detalhes do agendamento')
@section('content')
<div class="list-heading"><div><a class="back-link" href="{{ route('agendamentos.index') }}">← Voltar para agendamentos</a><h1>Agendamento #{{ $agendamento->id }}</h1><p>Resumo do atendimento solicitado.</p></div><a class="btn btn-primary" href="{{ route('agendamentos.edit',$agendamento) }}">Editar agendamento</a></div>
<div class="content-card detail-card"><div class="detail-grid"><div><small>Cliente</small><strong>{{ $agendamento->cliente->nome }}</strong></div><div><small>Telefone</small><strong>{{ $agendamento->cliente->telefone }}</strong></div><div><small>Serviço</small><strong>{{ $agendamento->servico->nome }}</strong></div><div><small>Data e horário</small><strong>{{ $agendamento->data->format('d/m/Y') }} às {{ substr($agendamento->horario,0,5) }}</strong></div><div><small>Status</small><strong>{{ $agendamento->status }}</strong></div><div><small>Endereço</small><strong>{{ $agendamento->endereco->rua }}, {{ $agendamento->endereco->numero }} — {{ $agendamento->endereco->cidade }}</strong></div></div>@if($agendamento->descricao)<h2 class="section-spaced">Observações</h2><p>{{ $agendamento->descricao }}</p>@endif</div>
@endsection
