<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Servico;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function index()
    {
        $agendamentos = Agendamento::with(['cliente', 'endereco', 'servico'])
            ->orderByDesc('data')->paginate(10);

        return view('agendamentos.index', compact('agendamentos'));
    }

    public function create()
    {
        return view('agendamentos.create', $this->dadosFormulario(new Agendamento()));
    }

    public function store(Request $request)
    {
        Agendamento::create($this->validar($request));
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento cadastrado com sucesso!');
    }

    public function show(Agendamento $agendamento)
    {
        $agendamento->load(['cliente', 'endereco', 'servico']);
        return view('agendamentos.show', compact('agendamento'));
    }

    public function edit(Agendamento $agendamento)
    {
        return view('agendamentos.edit', $this->dadosFormulario($agendamento));
    }

    public function update(Request $request, Agendamento $agendamento)
    {
        $agendamento->update($this->validar($request));
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento atualizado com sucesso!');
    }

    public function destroy(Agendamento $agendamento)
    {
        $agendamento->delete();
        return redirect()->route('agendamentos.index')->with('success', 'Agendamento excluído com sucesso!');
    }

    private function dadosFormulario(Agendamento $agendamento): array
    {
        return [
            'agendamento' => $agendamento,
            'clientes' => Cliente::with('enderecos')->orderBy('nome')->get(),
            'enderecos' => Endereco::with('cliente')->orderBy('rua')->get(),
            'servicos' => Servico::where('ativo', true)->orderBy('nome')->get(),
            'status' => ['Pendente', 'Confirmado', 'Em andamento', 'Concluído', 'Cancelado'],
        ];
    }

    private function validar(Request $request): array
    {
        $dados = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'endereco_id' => 'required|exists:enderecos,id',
            'servico_id' => 'required|exists:servicos,id',
            'data' => 'required|date_format:Y-m-d|after_or_equal:today',
            'horario' => 'required|date_format:H:i',
            'status' => 'required|in:Pendente,Confirmado,Em andamento,Concluído,Cancelado',
            'descricao' => 'nullable|string|max:1000',
        ], [
            'cliente_id.required' => 'Selecione o cliente para este atendimento.',
            'endereco_id.required' => 'Selecione o endereço onde o serviço será realizado.',
            'servico_id.required' => 'Escolha o tipo de serviço.',
            'data.required' => 'Informe a data do atendimento.',
            'data.date_format' => 'A data informada não é válida. Escolha uma data no calendário.',
            'data.after_or_equal' => 'A data do atendimento não pode ser anterior a hoje.',
            'horario.required' => 'Informe o horário do atendimento.',
            'horario.date_format' => 'Horário inválido. Informe um horário válido no formato HH:MM.',
        ]);

        $endereco = Endereco::findOrFail($dados['endereco_id']);
        if ((int) $endereco->cliente_id !== (int) $dados['cliente_id']) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'endereco_id' => 'O endereço selecionado não pertence ao cliente escolhido.'
            ]);
        }

        return $dados;
    }
}
