<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'email',
        'website',
        'phone',
        'address',
        'bio',
        'logo',
        'hiring_thumbnail',
    ];

    protected $searchableFields = ['*'];
}
