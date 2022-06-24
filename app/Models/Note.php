<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'content',
        'related_to_id',
        'created_by',
        'job_id',
        'updated_by',
        'job_applicant_id',
    ];

    protected $searchableFields = ['*'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function jobApplicant()
    {
        return $this->belongsTo(JobApplicant::class);
    }
}
