<?php

use App\Http\Controllers\{
    AuthController,
    PizzaController,
    UserController
};
use Illuminate\Support\Facades\Route;

// Rota de teste
Route::get('/test', function () {
    return response()->json(['status' => 'ok']);
});

// Rotas públicas (acessíveis sem autenticação)
Route::prefix('/public')->group(function () {
    Route::post('/user/login', [AuthController::class, 'login']);
    Route::post('/user/cadastrar', [UserController::class, 'store']);
    Route::get('/pizza', [PizzaController::class, 'index']);
    Route::post('/pizza/cadastrar', [PizzaController::class, 'store']);
    Route::put('/pizza/atualizar/{id}', [PizzaController::class, 'update']);
    Route::delete('/pizza/deletar/{id}', [PizzaController::class, 'destroy']);
    Route::get('/pizza/visualizar/{id}', [PizzaController::class, 'show']);
});

// Rotas protegidas com autenticação
Route::middleware('auth:api')->group(function () {
    // Rotas relacionadas a usuários
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'me']);
        Route::get('/listar', [UserController::class, 'index']);
        Route::put('/atualizar/{id}', [UserController::class, 'update']);
        Route::delete('/deletar/{id}', [UserController::class, 'destroy']);
        Route::get('/visualizar/{id}', [UserController::class, 'show']);
    });
});
