<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $fillable = ['permission_group_id'];

    protected $table = 'permissions';

    protected $hidden = ['pivot', 'created_at', 'updated_at', 'guard_name'];

    public function group()
    {
        return $this->belongsTo(PermissionGroup::class, 'group_id');
    }
}
