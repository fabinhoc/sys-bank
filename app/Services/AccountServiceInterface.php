<?php

namespace App\Services;

use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

interface AccountServiceInterface
{
   /**
    * @param StoreAccountRequest $request
    * @return Model
    */
   public function store(StoreAccountRequest $request): ?Model;

   /**
    * @return Collection
    */
   public function all(): Collection;

   /**
    * @param int $id
    * @param StoreAccountRequest $request
    * @return int
    */
   public function update(int $id, StoreAccountRequest $request): int;
   
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