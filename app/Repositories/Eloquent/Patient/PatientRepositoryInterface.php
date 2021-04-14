<?php
namespace App\Repositories\Eloquent\Patient;

use App\Models\User;
use Illuminate\Support\Collection;

interface PatientRepositoryInterface
{
   public function all(): Collection;

   public function getProfileDetails() ;

   public function updatePatientDetails(Array $array);
}