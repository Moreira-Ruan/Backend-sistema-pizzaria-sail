<?php

namespace App\Http\Controllers;

use App\Http\Requests\PizzaRequest;
use App\Services\PizzaServiceInterface;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    protected $pizzaService;

    public function __construct(PizzaServiceInterface $pizzaService)
    {
        $this->pizzaService = $pizzaService;
    }

    public function index()
    {
        // Delegar para o serviço
        return response()->json($this->pizzaService->listarPizzas());
    }

    public function store(PizzaRequest $request)
    {
        // Delegar para o serviço
        return response()->json($this->pizzaService->criarPizza($request->validated()));
    }

    public function update(PizzaRequest $request, $id)
    {
        // Delegar para o serviço
        return response()->json($this->pizzaService->atualizarPizza($request->validated(), $id));
    }

    public function destroy($id)
    {
        // Delegar para o serviço
        return response()->json($this->pizzaService->deletarPizza($id));
    }
}
