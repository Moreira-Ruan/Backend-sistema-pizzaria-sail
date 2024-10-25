<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Request;
use App\Services\UserServiceInterface;
use App\Models\User;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        // Delegar para o serviço
        return response()->json($this->userService->listarUsuarios());
    }

    public function me(Request $request)
    {
        return response()->json($request->user(), 200);
    }


    public function store(UserCreateRequest $request)
    {
        // Delegar para o serviço
        return response()->json($this->userService->criarUsuario($request->validated()));
    }

    public function update(UserCreateRequest $request, $id)
    {
        // Delegar para o serviço
        return response()->json($this->userService->atualizarUsuario($request->validated(), $id));
    }

    public function show($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'status' => 404,
            'message' => 'Usuário não encontrado'
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'user' => $user
    ], 200);
}


    public function destroy($id)
    {
        // Delegar para o serviço
        return response()->json($this->userService->deletarUsuario($id));
    }
}
