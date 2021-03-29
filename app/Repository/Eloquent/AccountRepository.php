<?php

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Repository\AccountRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{

   /**
    * AccountRepository constructor.
    *
    * @param Account $model
    */
    public function __construct(Account $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model::with('user')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public function find($id): ?Model
    {
        return $this->model::with('user')->where('id', '=', $id)->first();
    }
}