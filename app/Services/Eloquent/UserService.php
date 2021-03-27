<?php

namespace App\Services\Eloquent;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserServiceInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Boolean;

class UserService implements UserServiceInterface {

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(StoreUserRequest $request): ?Model
    {
        if (isset($request['password'])) {
            $request['password'] = Hash::make($request['password']);
        }

        return $this->userRepository->create($request->all());
    }

    public function all(): Collection
    {
        return $this->userRepository->all();
    }

    public function update(int $id, UpdateUserRequest $request): int
    {
        $resource = $this->userRepository->find($id);
        return $this->userRepository->update($id, $request->all());
    }

    public function show(int $id): ?Model
    {
        return $this->userRepository->find($id);
    }

    public function destroy(int $id): int
    {
        return $this->userRepository->destroy($id);
    }
}