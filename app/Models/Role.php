<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = ['user_id'];

    protected $table = 'roles';

    protected $hidden = ['pivot', 'guard_name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
