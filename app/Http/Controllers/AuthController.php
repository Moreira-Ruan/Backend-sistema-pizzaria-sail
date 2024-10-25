<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthServiceInterface;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        // Receber a credencial (email e senha)
        $credentials = $request->only('email', 'password');
        
        // Chama o serviço de autenticação
        return $this->authService->login($credentials);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        
        // Chama o serviço para revogar o token
        return $this->authService->logout($token);
    }
}
