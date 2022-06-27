<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'code'];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'created_at',
        'updated_at', 
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class, 'salary_currency_id');
    }
}
