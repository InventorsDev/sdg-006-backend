<?php

namespace App\Models;

use Spatie\Permission\Models\Role as BaseRole;
use App\Traits\UsesUuidTrait;

class Role extends BaseRole
{
    use UsesUuidTrait;
    public $guard_name = 'api';
}