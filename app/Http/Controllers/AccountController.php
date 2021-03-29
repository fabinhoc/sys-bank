<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccountRequest;
use App\Services\AccountServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $accountService;

    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;    
    }

    public function store(StoreAccountRequest $request): JsonResponse
    {
        return response()->json($this->accountService->store($request));
    }

    public function index(): JsonResponse
    {
        return response()->json($this->accountService->all());
    }

    public function update(int $id, StoreAccountRequest $request): JsonResponse
    {
        return response()->json($this->accountService->update($id, $request));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->accountService->show($id));
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->accountService->destroy($id));
    }
}
