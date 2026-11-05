@extends('layouts.app')
@section('title', 'Cadastrar administrador')
@section('page-heading', 'Cadastrar administrador')
@section('content')
<div class="form-page-heading admin-heading"><a class="back-link" href="{{ route('dashboard') }}">← Voltar ao painel</a><h1>Adicionar administrador</h1><p>Crie um novo acesso seguro para gerenciar a GGS Ar Condicionados.</p></div>
<div class="admin-form-shell">
    <div class="admin-form-aside"><div class="admin-shield">♙</div><span class="admin-kicker">ACESSO ADMINISTRATIVO</span><h2>Mais controle para sua equipe.</h2><p>Preencha os dados ao lado para liberar o acesso ao painel de gestão.</p><div class="admin-security">✦ &nbsp; Senhas protegidas e acesso restrito</div></div>
    <form class="admin-form" method="POST" action="{{ route('admins.store') }}" novalidate>@csrf
        <div class="admin-form-title"><h2>Dados do administrador</h2><p>Todos os campos são obrigatórios.</p></div>
        <label class="admin-field"><span>Nome completo</span><span class="admin-input-wrap"><b>♙</b><input type="text" name="name" value="{{ old('name') }}" placeholder="Ex.: João da Silva" autocomplete="name" required></span></label>
        <label class="admin-field"><span>E-mail</span><span class="admin-input-wrap"><b>✉</b><input type="email" name="email" value="{{ old('email') }}" placeholder="nome@empresa.com" autocomplete="email" required></span></label>
        <div class="admin-form-grid">
            <label class="admin-field"><span>Senha <small>(mínimo 8 caracteres)</small></span><span class="admin-input-wrap"><b>⌑</b><input type="password" name="password" placeholder="Crie uma senha" autocomplete="new-password" minlength="8" required></span></label>
            <label class="admin-field"><span>Confirmar senha</span><span class="admin-input-wrap"><b>✓</b><input type="password" name="password_confirmation" placeholder="Repita a senha" autocomplete="new-password" minlength="8" required></span></label>
        </div>
        <div class="admin-form-actions"><a class="btn btn-light" href="{{ route('dashboard') }}">Cancelar</a><button class="btn btn-primary" type="submit">＋ Cadastrar administrador</button></div>
    </form>
</div>
@endsection
