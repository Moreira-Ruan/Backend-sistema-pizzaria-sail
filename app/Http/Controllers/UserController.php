<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        Log::info('Entrou no método index do UserController');
        try {
            $users = User::select('id', 'name', 'email', 'created_at')->paginate(10);
            return response()->json([
                'status' => 200,
                'mensagem' => 'Usuários encontrados com sucesso!',
                'users' => $users
            ]);
        } catch (\Exception $e) {
            Log::error('Erro no método index do UserController: ' . $e->getMessage());
            return response()->json(['status' => 500, 'mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function me()
    {
        $user = Auth::user();

        return [
            'status' => 200,
            'message' => 'Usuário logado!',
            "usuario" => $user
        ];
    }

    public function store(UserCreateRequest $request)
    {
        Log::info('Entrou no método store do UserController');
        try {
            $data = $request->all();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
            return response()->json([
                'status' => 200,
                'mensagem' => 'Usuário cadastrado com sucesso!',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error('Erro no método store do UserController: ' . $e->getMessage());
            return response()->json(['status' => 500, 'mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function show(string $id)
    {
        Log::info('Entrou no método show do UserController');
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'mensagem' => 'Usuário não encontrado!',
                ], 404);
            }
            return response()->json([
                'status' => 200,
                'mensagem' => 'Usuário encontrado com sucesso!',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error('Erro no método show do UserController: ' . $e->getMessage());
            return response()->json(['status' => 500, 'mensagem' => 'Erro interno do servidor'], 500);
        }
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        Log::info('Entrou no método update do UserController');
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'mensagem' => 'Usuário não encontrado!',
                ], 404);
            }

            // Valida os dados do request
            $data = $request->validated();

            // Remove os campos de senha do array de dados se não foram preenchidos
            if (!$request->filled('password')) {
                unset($data['password']);
                unset($data['password_confirmation']);
            }

            $user->update($data);

            return response()->json([
                'status' => 200,
                'mensagem' => 'Usuário atualizado com sucesso!',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error('Erro no método update do UserController: ' . $e->getMessage());
            return response()->json(['status' => 500, 'mensagem' => 'Erro interno do servidor'], 500);
        }
    }


    public function destroy(string $id)
    {
        Log::info('Entrou no método destroy do UserController');
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'mensagem' => 'Usuário não encontrado!',
                ], 404);
            }
            $user->delete();
            return response()->json([
                'status' => 200,
                'mensagem' => 'Usuário deletado com sucesso!',
            ]);
        } catch (\Exception $e) {
            Log::error('Erro no método destroy do UserController: ' . $e->getMessage());
            return response()->json(['status' => 500, 'mensagem' => 'Erro interno do servidor'], 500);
        }
    }
}
