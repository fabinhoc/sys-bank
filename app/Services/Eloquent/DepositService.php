<?php

namespace App\Services\Eloquent;

use App\Http\Requests\StoreDepositRequest;
use App\Http\Requests\StoreExpenseRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repository\DepositRepositoryInterface;
use App\Services\UserServiceInterface;
use App\Repository\UserRepositoryInterface;
use App\Services\DepositServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Boolean;

class DepositService implements DepositServiceInterface {

    private $depositRepository;

    public function __construct(DepositRepositoryInterface $depositRepository)
    {
        $this->depositRepository = $depositRepository;
    }

    public function store(StoreDepositRequest $request): ?Model
    {
        return $this->depositRepository->create($request->all());
    }

    public function all(): Collection
    {
        return $this->depositRepository->all();
    }

    public function update(int $id, StoreDepositRequest $request): int
    {
        $resource = $this->depositRepository->find($id);
        return $this->depositRepository->update($id, $request->all());
    }

    public function show(int $id): ?Model
    {
        return $this->depositRepository->find($id);
    }

    public function destroy(int $id): int
    {
        return $this->depositRepository->destroy($id);
    }
}