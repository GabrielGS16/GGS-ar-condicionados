<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember')) &&
            Auth::user()->is_admin) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        Auth::logout();
        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos, ou conta sem acesso administrativo.',
        ])->onlyInput('email');
    }

    public function showFirstAdmin()
    {
        if (User::where('is_admin', true)->exists()) {
            return redirect()->route('login')
                ->with('error', 'O cadastro inicial já foi realizado. Entre com sua conta.');
        }

        return view('auth.first-admin');
    }

    public function storeFirstAdmin(Request $request)
    {
        if (User::where('is_admin', true)->exists()) {
            return redirect()->route('login')
                ->with('error', 'Já existe um administrador cadastrado.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $admin = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => true,
        ]);

        Auth::login($admin);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Administrador criado com sucesso!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Você saiu do sistema com segurança.');
    }
}
