<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService implements UserServiceInterface
{
    public function listarUsuarios()
    {
        try {
            return User::paginate(10);
        } catch (\Exception $e) {
            Log::error('Erro ao listar usuários: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao listar usuários'];
        }
    }

    public function criarUsuario(array $data)
    {
        try {
            $user = User::create($data);
            return ['status' => true, 'message' => 'Usuário criado com sucesso!', 'user' => $user];
        } catch (\Exception $e) {
            Log::error('Erro ao criar usuário: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao criar usuário'];
        }
    }

    public function atualizarUsuario(array $data, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return ['status' => false, 'message' => 'Usuário não encontrado!'];
            }

            $user->update($data);
            return ['status' => true, 'message' => 'Usuário atualizado com sucesso!', 'user' => $user];
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar usuário: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao atualizar usuário'];
        }
    }

    public function deletarUsuario($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return ['status' => false, 'message' => 'Usuário não encontrado!'];
            }

            $user->delete();
            return ['status' => true, 'message' => 'Usuário deletado com sucesso!'];
        } catch (\Exception $e) {
            Log::error('Erro ao deletar usuário: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao deletar usuário'];
        }
    }
}
