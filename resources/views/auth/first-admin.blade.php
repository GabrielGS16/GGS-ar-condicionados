<!DOCTYPE html>
<html lang="pt-BR"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Primeiro administrador | GGS</title><link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>
body{min-height:100vh;display:grid;place-items:center;background:linear-gradient(135deg,#071d49,#1263b5);padding:24px}
.auth-card{width:min(480px,100%);background:white;border-radius:20px;padding:36px;box-shadow:0 25px 70px #00153855}
h1{color:#102b55;margin-top:0}.muted{color:#64748b}.auth-card label{display:block;font-weight:700;margin:14px 0 6px}
.auth-card input{width:100%;padding:12px;border:1px solid #d9e1ed;border-radius:8px;font:inherit}
.btn-auth{width:100%;border:0;border-radius:8px;background:#e52d3c;color:white;padding:14px;font-weight:800;margin-top:22px;cursor:pointer}
.error{color:#b42332}
</style></head><body><div class="auth-card">
<h1>❄ Criar administrador</h1><p class="muted">Configure a primeira conta responsável pelo painel da GGS.</p>
@if($errors->any())<div class="error">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
<form method="POST" action="{{ route('admin.first.store') }}">@csrf
<label>Nome completo</label><input name="name" value="{{ old('name') }}" required>
<label>E-mail</label><input type="email" name="email" value="{{ old('email') }}" required>
<label>Senha (mínimo 8 caracteres)</label><input type="password" name="password" required>
<label>Confirme a senha</label><input type="password" name="password_confirmation" required>
<button class="btn-auth" type="submit">Criar primeiro administrador</button>
</form></div></body></html>
