<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::withCount(['enderecos', 'agendamentos'])
            ->orderBy('nome')->paginate(10);

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create', ['cliente' => new Cliente()]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:150',
            'telefone' => 'required|string|max:25',
            'email' => 'nullable|email|max:150',
            'observacoes' => 'nullable|string|max:1000',
        ]);

        Cliente::create($dados);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load(['enderecos', 'agendamentos.servico']);
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:150',
            'telefone' => 'required|string|max:25',
            'email' => 'nullable|email|max:150',
            'observacoes' => 'nullable|string|max:1000',
        ]);

        $cliente->update($dados);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->agendamentos()->exists()) {
            return back()->with('error', 'Não é possível excluir: este cliente possui agendamentos.');
        }

        $cliente->enderecos()->delete();
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
