<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Cliente;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function index()
    {
        $enderecos = Endereco::with('cliente')->latest()->paginate(10);
        return view('enderecos.index', compact('enderecos'));
    }

    public function create()
    {
        return view('enderecos.create', [
            'endereco' => new Endereco(),
            'clientes' => Cliente::orderBy('nome')->get()
        ]);
    }

    public function store(Request $request)
    {
        $dados = $this->validar($request);
        Endereco::create($dados);
        return redirect()->route('enderecos.index')->with('success', 'Endereço cadastrado com sucesso!');
    }

    public function show(Endereco $endereco)
    {
        $endereco->load(['cliente', 'agendamentos']);
        return view('enderecos.show', compact('endereco'));
    }

    public function edit(Endereco $endereco)
    {
        return view('enderecos.edit', [
            'endereco' => $endereco,
            'clientes' => Cliente::orderBy('nome')->get()
        ]);
    }

    public function update(Request $request, Endereco $endereco)
    {
        $endereco->update($this->validar($request));
        return redirect()->route('enderecos.index')->with('success', 'Endereço atualizado com sucesso!');
    }

    public function destroy(Endereco $endereco)
    {
        if ($endereco->agendamentos()->exists()) {
            return back()->with('error', 'Este endereço está vinculado a um agendamento.');
        }

        $endereco->delete();
        return redirect()->route('enderecos.index')->with('success', 'Endereço excluído com sucesso!');
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'cep' => 'required|string|max:9',
            'rua' => 'required|string|max:150',
            'numero' => 'required|string|max:20',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|size:2',
        ]);
    }
}
