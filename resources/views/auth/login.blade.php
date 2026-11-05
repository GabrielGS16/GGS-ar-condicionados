<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entrar | GGS Ar Condicionados</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body{min-height:100vh;display:grid;place-items:center;background:linear-gradient(135deg,#071d49,#1263b5);padding:24px}
        .auth-card{width:min(440px,100%);background:#fff;border-radius:20px;padding:38px;box-shadow:0 25px 70px #00153855}
        .auth-brand{text-align:center;margin-bottom:28px}.auth-brand .brand-mark{font-size:34px;color:#e52d3c}
        .auth-brand h1{margin:8px 0 3px;color:#102b55}.auth-brand p{color:#718096;margin:0}
        .auth-card label{display:block;font-weight:700;margin:16px 0 7px;color:#243b5a}
        .auth-card input{width:100%;padding:13px 14px;border:1px solid #d9e1ed;border-radius:9px;font:inherit}
        .auth-card .btn-auth{width:100%;border:0;border-radius:9px;background:#e52d3c;color:white;padding:14px;font-weight:800;margin-top:22px;cursor:pointer}
        .auth-error{background:#fff0f0;color:#b42332;padding:12px;border-radius:8px;margin-bottom:12px}
        .auth-link{text-align:center;margin-top:20px;color:#64748b}.auth-link a{color:#1263b5;font-weight:700}
    </style>
</head>
<body>
<div class="auth-card">
    <div class="auth-brand"><div class="brand-mark">❄</div><h1>GGS AR CONDICIONADOS</h1><p>Acesso ao painel administrativo</p></div>
    @if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="auth-error">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="auth-error">@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>@endif
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <label for="email">E-mail</label><input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        <label for="password">Senha</label><input id="password" type="password" name="password" required>
        <label style="display:flex;align-items:center;gap:8px;font-weight:500"><input style="width:auto" type="checkbox" name="remember" value="1"> Manter conectado</label>
        <button class="btn-auth" type="submit">Entrar no sistema</button>
    </form>
    @if(!\App\Models\User::where('is_admin', true)->exists())
        <div class="auth-link"><a href="{{ route('admin.first.create') }}">Configurar primeiro administrador</a></div>
    @endif
</div>
</body></html>
