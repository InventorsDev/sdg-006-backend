<?php
namespace App\Repositories\Eloquent\Specialist;

use App\Models\User;
use Illuminate\Support\Collection;

interface SpecialistRepositoryInterface
{
   public function all(): Collection;

   public function getProfileDetails();

   public function updateSpecialistDetails(Array $array);
}