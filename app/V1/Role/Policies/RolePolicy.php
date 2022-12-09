<?php

namespace App\V1\Role\Policies;

use App\V1\User\Models\User;
use App\V1\Role\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    
    public function seeRoles(User $user)
    {
        if ($user->isAdmin()) {
             return true;
        }
    }
}
