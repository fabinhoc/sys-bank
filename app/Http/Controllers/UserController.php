<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;    
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        return response()->json($this->userService->store($request));
    }

    public function index(): JsonResponse
    {
        return response()->json($this->userService->all());
    }

    public function update(int $id, UpdateUserRequest $request): JsonResponse
    {
        return response()->json($this->userService->update($id, $request));
    }

    public function show(int $id): JsonResponse
    {
        return response()->json($this->userService->show($id));
    }

    public function destroy(int $id): JsonResponse
    {
        return response()->json($this->userService->destroy($id));
    }
}
