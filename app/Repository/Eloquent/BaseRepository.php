<?php

namespace App\Repository\Eloquent;   

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
 
    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model->all();
    }
   
    /**
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes): ?Model
    {
         return $this->model::create($attributes);
    }

    public function update(int $id, array $attributes): int
    {
        return $this->model::where('id', $id)->update($attributes);
    }

    public function destroy(int $id): int
    {
        return $this->model::where('id', $id)->delete();
    }
}
