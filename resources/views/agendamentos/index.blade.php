@extends('layouts.app')
@section('title', 'Agendamentos')
@section('page-heading', 'Agendamentos')
@section('content')
<div class="list-heading"><div><h1>Agendamentos</h1><p>Organize instalações e manutenções.</p></div><a class="btn btn-primary" href="{{ route('agendamentos.create') }}">＋ Novo agendamento</a></div>
<div class="content-card"><div class="table-wrap"><table><thead><tr><th>CLIENTE</th><th>SERVIÇO</th><th>DATA / HORA</th><th>STATUS</th><th>AÇÕES</th></tr></thead><tbody>
@forelse($agendamentos as $item)<tr><td><strong>{{ $item->cliente->nome }}</strong><small class="table-sub">{{ $item->cliente->telefone }}</small></td><td>{{ $item->servico->nome }}</td><td>{{ $item->data->format('d/m/Y') }}<small class="table-sub">{{ substr($item->horario,0,5) }}</small></td><td><span class="status status-{{ \Illuminate\Support\Str::slug($item->status) }}">{{ $item->status }}</span></td><td class="actions"><a href="{{ route('agendamentos.show',$item) }}">Ver</a><a href="{{ route('agendamentos.edit',$item) }}">Editar</a><form method="POST" action="{{ route('agendamentos.destroy',$item) }}" data-confirm="Deseja excluir este agendamento?">@csrf @method('DELETE')<button class="danger-link">Excluir</button></form></td></tr>
@empty<tr><td colspan="5" class="empty">Nenhum agendamento cadastrado.</td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $agendamentos->links() }}</div></div>
@endsection
