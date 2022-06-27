<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobFunction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'created_at',
        'updated_at', 
    ];

    protected $table = 'job_functions';

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
