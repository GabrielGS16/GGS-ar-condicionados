<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained()->restrictOnDelete();
            $table->foreignId('endereco_id')->constrained()->restrictOnDelete();
            $table->foreignId('servico_id')->constrained()->restrictOnDelete();
            $table->date('data');
            $table->time('horario');
            $table->string('status', 30)->default('Pendente');
            $table->text('descricao')->nullable();
            $table->timestamps();
            $table->index(['data', 'horario']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
