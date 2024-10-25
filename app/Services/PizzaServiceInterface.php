<?php

namespace App\Services;

interface PizzaServiceInterface
{
    public function listarPizzas();
    public function criarPizza(array $data);
    public function atualizarPizza(array $data, $id);
    public function deletarPizza($id);
}
