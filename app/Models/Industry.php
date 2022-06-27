<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Industry extends Model
{
    use HasFactory;
    use Searchable;

    protected $hidden = [
        'created_at',
        'updated_at', 
    ];

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
