<?php
namespace App\Repositories;


use Illuminate\Database\Eloquent\Model; 
use Illuminate\Support\Collection;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{
   /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * @return Model
    */
   public function find($id): ?Model;

   /**
    * @return Collection
    */
   public function all(): Collection;

   /**
    * @return Bool
    * @param $id
    */
   public function delete($id):bool;
}