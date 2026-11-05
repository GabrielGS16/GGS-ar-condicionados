<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Agendamento;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalClientes' => Cliente::count(),
            'totalAgendamentos' => Agendamento::count(),
            'pendentes' => Agendamento::where('status', 'Pendente')->count(),
            'concluidos' => Agendamento::where('status', 'Concluído')->count(),
            'ultimosAgendamentos' => Agendamento::with(['cliente', 'servico'])
                ->latest()->take(6)->get(),
        ]);
    }
}
