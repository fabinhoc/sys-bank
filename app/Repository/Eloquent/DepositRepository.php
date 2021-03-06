<?php

namespace App\Repository\Eloquent;

use App\Models\Deposit;
use App\Repository\DepositRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DepositRepository extends BaseRepository implements DepositRepositoryInterface
{

   /**
    * DepositRepository constructor.
    *
    * @param Deposit $model
    */
    public function __construct(Deposit $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model::with('user')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('created_at')
            ->get();
    }

    public function find($id): ?Model
    {
        return $this->model::with('user')->where('id', '=', $id)->first();
    }
}