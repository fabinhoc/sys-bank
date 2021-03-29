<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Services\AccountServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $depositeService;

    public function __construct(AccountServiceInterface $depositeService)
    {
        $this->depositeService = $depositeService;    
    }

    public function store(StoreAccountRequest $request): JsonResponse
    {
        return response()->json($this->depositeService->store($request));
    }

    public function index(): JsonResponse
    {
        return response()->json($this->depositeService->all());
    }

    public function update(int $id, StoreAccountRequest $request): JsonResponse
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
