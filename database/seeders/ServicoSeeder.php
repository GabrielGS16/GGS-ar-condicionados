<?php

namespace Database\Seeders;

use App\Models\Servico;
use Illuminate\Database\Seeder;

class ServicoSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['nome' => 'Instalação de ar-condicionado', 'descricao' => 'Instalação de aparelho split.', 'preco' => 0],
            ['nome' => 'Manutenção preventiva', 'descricao' => 'Limpeza e revisão periódica.', 'preco' => 0],
            ['nome' => 'Manutenção corretiva', 'descricao' => 'Diagnóstico e reparo de falhas.', 'preco' => 0],
        ] as $servico) {
            Servico::firstOrCreate(['nome' => $servico['nome']], $servico + ['ativo' => true]);
        }
    }
}
