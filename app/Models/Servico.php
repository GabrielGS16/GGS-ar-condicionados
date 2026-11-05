<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = ['nome', 'descricao', 'preco', 'ativo'];

    protected $casts = [
        'preco' => 'decimal:2',
        'ativo' => 'boolean',
    ];

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
