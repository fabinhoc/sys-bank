<?php

namespace App\Services;

use App\Http\Requests\StoreDepositRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

interface DepositServiceInterface
{
   /**
    * @param StoreDepositRequest $request
    * @return Model
    */
   public function store(StoreDepositRequest $request): ?Model;

   /**
    * @return Collection
    */
   public function all(): Collection;

   /**
    * @param int $id
    * @param StoreDepositRequest $request
    * @return int
    */
   public function update(int $id, StoreDepositRequest $request): int;
   
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