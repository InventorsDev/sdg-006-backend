<?php

namespace App\Repositories\Eloquent\Patient;

use App\Models\User;
use App\Repositories\Eloquent\Patient\PatientRepositoryInterface; 
use App\Repositories\Eloquent\BaseRepository; 
use Illuminate\Support\Collection;

class PatientRepository extends BaseRepository implements PatientRepositoryInterface
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
       return $this->model->isMedhousePatient()->get();    
   }
}