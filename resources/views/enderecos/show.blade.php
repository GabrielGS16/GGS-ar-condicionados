@extends('layouts.app')
@section('title', 'Detalhes do endereço')
@section('page-heading', 'Detalhes do endereço')
@section('content')
<div class="list-heading"><div><a class="back-link" href="{{ route('enderecos.index') }}">← Voltar para endereços</a><h1>Endereço de {{ $endereco->cliente->nome }}</h1></div><a class="btn btn-primary" href="{{ route('enderecos.edit',$endereco) }}">Editar endereço</a></div>
<div class="content-card detail-card"><h2>Local de atendimento</h2><p>{{ $endereco->rua }}, {{ $endereco->numero }} {{ $endereco->complemento }}</p><p>{{ $endereco->bairro }} — {{ $endereco->cidade }}/{{ $endereco->estado }}</p><p>CEP: {{ $endereco->cep }}</p></div>
@endsection
