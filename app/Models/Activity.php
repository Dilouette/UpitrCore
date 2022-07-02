<?php

namespace App\Models;

use App\Enums\ActivityTypes;
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

    protected $hidden = [        
        'activity_type_id',
        'related_to_id',
        'importance_id',
        'job_applicant_id',
        'job_id',
    ];

    protected $appends = ['activity_type'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function jobApplicant()
    {
        return $this->belongsTo(JobApplicant::class);
    }

    /**
     * Get the activity's true type.
     *
     * @param  string  $value
     * @return string
     */
    public function getActivityTypeAttribute()
    {
        return ActivityTypes::getDescription($this->activity_type_id);
    }
}
