<?php

namespace App\Repositories\Eloquent\Shared\User;

use App\Models\User;
use App\Repositories\Eloquent\Shared\User\UserRepositoryInterface; 
use App\Repositories\Eloquent\BaseRepository; 
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
   {
       parent::__construct($model);
   }

   public function updateAccountPassword(Array $data)
   {
        $id = auth('api')->user()->id ? auth('api')->user()->id : "";
        return $this->model->where('id', $id)->firstOrFail()->update($data);
   }
}