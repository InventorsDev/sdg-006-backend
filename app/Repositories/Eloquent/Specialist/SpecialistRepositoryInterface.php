<?php
namespace App\Repositories\Eloquent\Specialist;

use App\Models\User;
use Illuminate\Support\Collection;

interface SpecialistRepositoryInterface
{
   public function all(): Collection;
}