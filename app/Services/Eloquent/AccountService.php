<?php

namespace App\Services\Eloquent;

use App\Http\Requests\StoreAccountRequest;
use App\Repository\AccountRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Repository\UserRepositoryInterface;
use App\Services\AccountServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class AccountService implements AccountServiceInterface {

    private $expenseRepository;

    public function __construct(AccountRepositoryInterface $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function store(StoreAccountRequest $request): ?Model
    {
        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }

        return $this->expenseRepository->create($request->all());
    }

    public function all(): Collection
    {
        return $this->expenseRepository->all();
    }

    public function update(int $id, StoreAccountRequest $request): int
    {
        $resource = $this->expenseRepository->find($id);
        return $this->expenseRepository->update($id, $request->all());
    }

    public function show(int $id): ?Model
    {
        return $this->expenseRepository->find($id);
    }

    public function destroy(int $id): int
    {
        return $this->expenseRepository->destroy($id);
    }
}