<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assesment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['job_id', 'is_timed','pass_score','questions_per_candidate', 'duration'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'is_timed' => 'boolean',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function assesmentQuestions()
    {
        return $this->hasMany(AssesmentQuestion::class);
    }
}
