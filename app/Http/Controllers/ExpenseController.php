<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\ExpenseServiceInterface;
use App\Http\Requests\StoreExpenseRequest;

class ExpenseController extends Controller
{
    private $expenseService;

    public function __construct(ExpenseServiceInterface $expenseService)
    {
        $this->expenseService = $expenseService;    
    }

    public function store(StoreExpenseRequest $request): JsonResponse
    {
        return response()->json($this->expenseService->store($request));
    }

    public function index(): JsonResponse
    {
        return response()->json($this->expenseService->all());
    }

    public function update(int $id, StoreExpenseRequest $request): JsonResponse
    {
        return response()->json($this->expenseService->update($id, $request));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->expenseService->show($id));
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->expenseService->destroy($id));
    }
}
