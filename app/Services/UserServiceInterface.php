<?php

namespace App\Services;

interface UserServiceInterface
{
    public function listarUsuarios();
    public function criarUsuario(array $data);
    public function atualizarUsuario(array $data, $id);
    public function deletarUsuario($id);
}
