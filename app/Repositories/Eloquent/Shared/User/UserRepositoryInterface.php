<?php
namespace App\Repositories\Eloquent\Shared\User;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
   public function updateAccountPassword(Array $data);
}