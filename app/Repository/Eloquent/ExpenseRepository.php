<?php

namespace App\Repository\Eloquent;

use App\Models\Expense;
use App\Repository\ExpenseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ExpenseRepository extends BaseRepository implements ExpenseRepositoryInterface
{

   /**
    * ExpenseRepository constructor.
    *
    * @param Expense $model
    */
    public function __construct(Expense $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model::with('user')->orderBy('created_at', 'ASC')->get();
    }

    public function find($id): ?Model
    {
        return $this->model::with('user')->where('id', '=', $id)->first();
    }
}