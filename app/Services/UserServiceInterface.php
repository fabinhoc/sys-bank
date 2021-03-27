<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

interface UserServiceInterface
{
   /**
    * @param StoreUserRequest $request
    * @return Model
    */
   public function store(StoreUserRequest $request): ?Model;

   /**
    * @return Collection
    */
   public function all(): Collection;

   /**
    * @param int $id
    * @param StoreUserRequest $request
    * @return int
    */
   public function update(int $id, UpdateUserRequest $request): int;
   
   /**
    * @param int $id
    * @return int
    */
   public function show(int $id): ?Model;
   
   /**
    * @param int $id
    * @return int
    */
   public function destroy(int $id): int;
}