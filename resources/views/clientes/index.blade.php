@extends('layouts.app')
@section('title', 'Clientes')
@section('page-heading', 'Clientes')
@section('content')
<div class="list-heading"><div><h1>Clientes</h1><p>Cadastre e gerencie os clientes da GGS.</p></div><a class="btn btn-primary" href="{{ route('clientes.create') }}">＋ Novo cliente</a></div>
<div class="content-card">
<div class="table-wrap"><table><thead><tr><th>NOME</th><th>TELEFONE</th><th>E-MAIL</th><th>ENDEREÇOS</th><th>AÇÕES</th></tr></thead><tbody>
@forelse($clientes as $cliente)
<tr><td><strong>{{ $cliente->nome }}</strong></td><td>{{ $cliente->telefone }}</td><td>{{ $cliente->email ?: '—' }}</td><td>{{ $cliente->enderecos_count }}</td><td class="actions"><a href="{{ route('clientes.show',$cliente) }}">Ver</a><a href="{{ route('clientes.edit',$cliente) }}">Editar</a><form method="POST" action="{{ route('clientes.destroy',$cliente) }}" data-confirm="Deseja excluir este cliente?">@csrf @method('DELETE')<button class="danger-link">Excluir</button></form></td></tr>
@empty<tr><td colspan="5" class="empty">Nenhum cliente encontrado. Cadastre o primeiro cliente.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $clientes->links() }}</div></div>
@endsection
