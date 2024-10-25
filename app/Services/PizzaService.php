<?php

namespace App\Services;

use App\Models\Pizza;
use Illuminate\Support\Facades\Log;

class PizzaService implements PizzaServiceInterface
{
    public function listarPizzas()
    {
        try {
            return Pizza::paginate(10);
        } catch (\Exception $e) {
            Log::error('Erro ao listar pizzas: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao listar pizzas'];
        }
    }

    public function criarPizza(array $data)
    {
        try {
            $pizza = Pizza::create($data);
            return ['status' => true, 'message' => 'Pizza criada com sucesso!', 'pizza' => $pizza];
        } catch (\Exception $e) {
            Log::error('Erro ao criar pizza: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao criar pizza'];
        }
    }

    public function atualizarPizza(array $data, $id)
    {
        try {
            $pizza = Pizza::find($id);
            if (!$pizza) {
                return ['status' => false, 'message' => 'Pizza não encontrada!'];
            }

            $pizza->update($data);
            return ['status' => true, 'message' => 'Pizza atualizada com sucesso!', 'pizza' => $pizza];
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar pizza: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao atualizar pizza'];
        }
    }

    public function deletarPizza($id)
    {
        try {
            $pizza = Pizza::find($id);
            if (!$pizza) {
                return ['status' => false, 'message' => 'Pizza não encontrada!'];
            }

            $pizza->delete();
            return ['status' => true, 'message' => 'Pizza deletada com sucesso!'];
        } catch (\Exception $e) {
            Log::error('Erro ao deletar pizza: ' . $e->getMessage());
            return ['status' => false, 'message' => 'Erro ao deletar pizza'];
        }
    }
}
