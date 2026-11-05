@extends('layouts.app')
@section('title', $endereco->exists ? 'Editar endereço' : 'Novo endereço')
@section('page-heading', 'Cadastro de endereços')
@section('content')
<div class="form-page-heading"><a class="back-link" href="{{ route('enderecos.index') }}">← Voltar para endereços</a><h1>{{ $endereco->exists ? 'Editar endereço' : 'Cadastrar endereço' }}</h1><p>Informe o cliente e o local onde o serviço será realizado.</p></div>
<form class="content-card form-card" method="POST" novalidate action="{{ $endereco->exists ? route('enderecos.update',$endereco) : route('enderecos.store') }}">@csrf @if($endereco->exists) @method('PUT') @endif
<div class="form-section-title"><span>01</span><div><strong>Vincular cliente</strong><small>Selecione o responsável pelo endereço</small></div></div>
<div class="form-grid"><label class="field full">Cliente *<select name="cliente_id" required><option value="">Selecione um cliente</option>@foreach($clientes as $cliente)<option value="{{ $cliente->id }}" @selected(old('cliente_id',$endereco->cliente_id)==$cliente->id)>{{ $cliente->nome }}</option>@endforeach</select></label></div>
<div class="form-section-title section-spaced"><span>02</span><div><strong>Localização</strong><small>Endereço completo para atendimento</small></div></div>
<div class="form-grid"><label class="field">CEP *<input name="cep" value="{{ old('cep',$endereco->cep) }}" placeholder="00000-000" required></label><label class="field">Rua / Avenida *<input name="rua" value="{{ old('rua',$endereco->rua) }}" required></label><label class="field">Número *<input name="numero" value="{{ old('numero',$endereco->numero) }}" required></label><label class="field">Complemento<input name="complemento" value="{{ old('complemento',$endereco->complemento) }}"></label><label class="field">Bairro *<input name="bairro" value="{{ old('bairro',$endereco->bairro) }}" required></label><label class="field">Cidade *<input name="cidade" value="{{ old('cidade',$endereco->cidade) }}" required></label><label class="field">Estado (UF) *<input name="estado" maxlength="2" value="{{ old('estado',$endereco->estado) }}" placeholder="CE" required></label></div>
<div class="form-actions"><a class="btn btn-light" href="{{ route('enderecos.index') }}">Cancelar</a><button class="btn btn-primary">Salvar endereço</button></div></form>
@endsection
