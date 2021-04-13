<?php

namespace App\Repositories\Eloquent\Specialist;

use App\Models\User;
use App\Repositories\Eloquent\Specialist\SpecialistRepositoryInterface; 
use App\Repositories\Eloquent\BaseRepository; 
use Illuminate\Support\Collection;

class SpecialistRepository extends BaseRepository implements SpecialistRepositoryInterface
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

   /**
    * @return Collection
    */
   public function all(): Collection
   {
        return $this->model->isMedhouseSpecialist()->get(); 
   }
}