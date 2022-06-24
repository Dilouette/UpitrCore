<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'activity_type_id',
        'title',
        'start',
        'end',
        'location',
        'meeting_url',
        'related_to_id',
        'importance_id',
        'description',
        'created_by',
        'updated_by',
        'job_applicant_id',
        'job_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function jobApplicant()
    {
        return $this->belongsTo(JobApplicant::class);
    }
}
