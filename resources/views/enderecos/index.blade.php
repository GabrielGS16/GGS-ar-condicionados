@extends('layouts.app')
@section('title', 'Endereços')
@section('page-heading', 'Endereços')
@section('content')
<div class="list-heading"><div><h1>Endereços</h1><p>Gerencie os locais de atendimento dos clientes.</p></div><a class="btn btn-primary" href="{{ route('enderecos.create') }}">＋ Novo endereço</a></div>
<div class="content-card"><div class="table-wrap"><table><thead><tr><th>CLIENTE</th><th>ENDEREÇO</th><th>CIDADE</th><th>CEP</th><th>AÇÕES</th></tr></thead><tbody>
@forelse($enderecos as $endereco)<tr><td><strong>{{ $endereco->cliente->nome }}</strong></td><td>{{ $endereco->rua }}, {{ $endereco->numero }} {{ $endereco->complemento }}</td><td>{{ $endereco->cidade }}/{{ $endereco->estado }}</td><td>{{ $endereco->cep }}</td><td class="actions"><a href="{{ route('enderecos.show',$endereco) }}">Ver</a><a href="{{ route('enderecos.edit',$endereco) }}">Editar</a><form method="POST" action="{{ route('enderecos.destroy',$endereco) }}" data-confirm="Deseja excluir este endereço?">@csrf @method('DELETE')<button class="danger-link">Excluir</button></form></td></tr>
@empty<tr><td colspan="5" class="empty">Nenhum endereço cadastrado.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $enderecos->links() }}</div></div>
@endsection
