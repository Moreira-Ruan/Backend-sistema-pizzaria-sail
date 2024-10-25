<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    public function login(array $credentials)
    {
        // Procurar o usuário pelo email
        $user = User::where('email', $credentials['email'])->first();

        // Verificar se o usuário foi encontrado e se a senha é válida
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Criar um token pessoal para o usuário
            $token = $user->createToken('Personal Access Token')->accessToken;

            return [
                'status' => true,
                'message' => 'Login realizado com sucesso!',
                'token' => $token,
                'user' => $user
            ];
        }

        return [
            'status' => false,
            'message' => 'Credenciais inválidas. Verifique seu email e senha.',
        ];
    }

    public function logout()
    {
        try {
            Auth::user()->token()->revoke();
            return ['status' => true, 'message' => 'Logout realizado com sucesso!'];
        } catch (\Exception $e) {
            Log::error('Erro ao realizar logout: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao realizar logout'];
        }
    }

    public function register(array $data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            return ['status' => true, 'message' => 'Usuário registrado com sucesso!', 'user' => $user];
        } catch (\Exception $e) {
            Log::error('Erro ao registrar usuário: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao registrar usuário'];
        }
    }

    public function refresh()
    {
        // Lógica para gerar um novo token
    }
}
