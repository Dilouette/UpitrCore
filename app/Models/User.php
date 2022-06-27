<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;
    use HasRoles;

    protected $fillable = [
        'email',
        'username',
        'firstname',
        'lastname',
        'department_id',
        'password',
        'reset_login',
        'first_login',
        'last_login',
        'designation_id',
        'is_active',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token','department_id','designation_id', 'roles'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'reset_login' => 'boolean',
        'first_login' => 'boolean',
        'last_login' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function isSuperAdmin()
    {
        return in_array($this->email, config('auth.super_admins'));
    }
    
}
