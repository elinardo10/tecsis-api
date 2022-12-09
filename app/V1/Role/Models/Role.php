<?php

namespace App\V1\Role\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    protected $fillable = [ 'name'];

    public function users()
    {
     return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
