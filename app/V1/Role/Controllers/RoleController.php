<?php

namespace App\V1\Role\Controllers;

use App\Http\Controllers\Controller;
use App\V1\Role\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $this->authorize('seeRoles');
        $roles = Role::orderBy('label', 'ASC')->get();
        return RoleResource::collection($roles);
    }
}
