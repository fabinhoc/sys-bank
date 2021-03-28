<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepositRequest;
use App\Services\DepositServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    private $depositeService;

    public function __construct(DepositServiceInterface $depositeService)
    {
        $this->depositeService = $depositeService;    
    }

    public function store(StoreDepositRequest $request): JsonResponse
    {
        return response()->json($this->depositeService->store($request));
    }

    public function index(): JsonResponse
    {
        return response()->json($this->depositeService->all());
    }

    public function update(int $id, StoreDepositRequest $request): JsonResponse
    {
        return response()->json($this->depositeService->update($id, $request));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->depositeService->show($id));
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->depositeService->destroy($id));
    }
}
