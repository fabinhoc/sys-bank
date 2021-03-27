<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{
     /**
    * @return EloquentCollection
    */
    public function all(): EloquentCollection;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;

   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): ?Model;
   
   /**
    * @param int $id
    * @param array $attributes
    * @return int
    */
    public function update(int $id, array $attributes): int;
   
    /**
    * @param int $id
    * @param array $attributes
    * @return int
    */
    public function destroy(int $id): int;
}
