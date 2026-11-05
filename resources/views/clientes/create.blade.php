@extends('layouts.app')
@section('title', $cliente->exists ? 'Editar cliente' : 'Novo cliente')
@section('page-heading', 'Cadastro de clientes')
@section('content')
<div class="form-page-heading"><a class="back-link" href="{{ route('clientes.index') }}">← Voltar para clientes</a><h1>{{ $cliente->exists ? 'Editar cliente' : 'Cadastrar cliente' }}</h1><p>Preencha os dados abaixo para manter o cadastro atualizado.</p></div>
<form class="content-card form-card" method="POST" novalidate action="{{ $cliente->exists ? route('clientes.update',$cliente) : route('clientes.store') }}">
@csrf @if($cliente->exists) @method('PUT') @endif
<div class="form-section-title"><span>01</span><div><strong>Informações pessoais</strong><small>Dados básicos do cliente</small></div></div>
<div class="form-grid"><label class="field full">Nome completo *<input name="nome" value="{{ old('nome',$cliente->nome) }}" placeholder="Ex.: João da Silva" required></label>
<label class="field">Telefone / WhatsApp *<input name="telefone" value="{{ old('telefone',$cliente->telefone) }}" placeholder="(00) 00000-0000" required></label>
<label class="field">E-mail<input type="email" name="email" value="{{ old('email',$cliente->email) }}" placeholder="cliente@email.com"></label>
<label class="field full">Observações<textarea name="observacoes" rows="3" placeholder="Informações adicionais...">{{ old('observacoes',$cliente->observacoes) }}</textarea></label></div>
<div class="form-actions"><a class="btn btn-light" href="{{ route('clientes.index') }}">Cancelar</a><button class="btn btn-primary">Salvar cliente</button></div>
</form>
@endsection
