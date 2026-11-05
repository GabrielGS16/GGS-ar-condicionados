@extends('layouts.app')
@section('title', $agendamento->exists ? 'Editar agendamento' : 'Novo agendamento')
@section('page-heading', 'Agendamentos')
@section('content')
<div class="form-page-heading"><a class="back-link" href="{{ route('agendamentos.index') }}">← Voltar para agendamentos</a><h1>{{ $agendamento->exists ? 'Editar agendamento' : 'Novo agendamento' }}</h1><p>Preencha os dados para reservar um atendimento.</p></div>
<form class="content-card form-card" method="POST" novalidate action="{{ $agendamento->exists ? route('agendamentos.update',$agendamento) : route('agendamentos.store') }}">@csrf @if($agendamento->exists) @method('PUT') @endif
<div class="form-section-title"><span>01</span><div><strong>Dados do atendimento</strong><small>Cliente, local e tipo de serviço</small></div></div>
<div class="form-grid">
<label class="field">Cliente *<select name="cliente_id" id="clienteSelect" required><option value="">Selecione</option>@foreach($clientes as $cliente)<option value="{{ $cliente->id }}" @selected(old('cliente_id',$agendamento->cliente_id)==$cliente->id)>{{ $cliente->nome }}</option>@endforeach</select></label>
<label class="field">Endereço *<select name="endereco_id" id="enderecoSelect" required><option value="">Selecione o endereço</option>@foreach($enderecos as $endereco)<option value="{{ $endereco->id }}" data-cliente="{{ $endereco->cliente_id }}" @selected(old('endereco_id',$agendamento->endereco_id)==$endereco->id)>{{ $endereco->rua }}, {{ $endereco->numero }} — {{ $endereco->cliente->nome }}</option>@endforeach</select></label>
<label class="field full">Serviço *<select name="servico_id" required><option value="">Selecione o serviço</option>@foreach($servicos as $servico)<option value="{{ $servico->id }}" @selected(old('servico_id',$agendamento->servico_id)==$servico->id)>{{ $servico->nome }}</option>@endforeach</select></label>
<label class="field">Data *<input type="date" name="data" min="{{ date('Y-m-d') }}" value="{{ old('data', $agendamento->exists ? $agendamento->data->format('Y-m-d') : '') }}" required></label>
<label class="field">Horário *<input type="time" name="horario" value="{{ old('horario', $agendamento->horario ? substr($agendamento->horario,0,5) : '') }}" required></label>
<label class="field">Status *<select name="status" required>@foreach($status as $opcao)<option @selected(old('status',$agendamento->status ?: 'Pendente')==$opcao)>{{ $opcao }}</option>@endforeach</select></label>
<label class="field full">Observações<textarea name="descricao" rows="3" placeholder="Detalhes do aparelho, problema relatado...">{{ old('descricao',$agendamento->descricao) }}</textarea></label>
</div><div class="form-actions"><a class="btn btn-light" href="{{ route('agendamentos.index') }}">Cancelar</a><button class="btn btn-primary">Salvar agendamento</button></div></form>
@endsection
