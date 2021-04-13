<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as BasePermission;
use App\Traits\UsesUuidTrait;

class Permission extends BasePermission
{
    use UsesUuidTrait;
    public $guard_name = 'api';
}