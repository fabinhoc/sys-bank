<?php

namespace App\Services;

use App\Http\Requests\StoreExpenseRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ExpenseServiceInterface
{
   /**
    * @param StoreExpenseRequest $request
    * @return Model
    */
   public function store(StoreExpenseRequest $request): ?Model;

   /**
    * @return Collection
    */
   public function all(): Collection;

   /**
    * @param int $id
    * @param StoreExpenseRequest $request
    * @return int
    */
   public function update(int $id, StoreExpenseRequest $request): int;
   
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