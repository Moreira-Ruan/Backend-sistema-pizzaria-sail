<?php

namespace App\Services;

use App\Models\User;

class AdminUserService extends UserService
{
    public function listarUsuariosAdmin()
    {
        return User::where('role', 'admin')->paginate(10);
    }
}
