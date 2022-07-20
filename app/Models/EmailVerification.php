<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailVerification extends Model
{
    use HasFactory;
    use Searchable;
    public $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['email', 'token', 'expires_at'];

    protected $searchableFields = ['*'];

    protected $table = 'email_verifications';

    protected $casts = [
        'expires_at' => 'datetime',
        'email' => 'string'
    ];
}
