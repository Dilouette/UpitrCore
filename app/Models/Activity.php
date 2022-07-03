<?php

namespace App\Models;

use App\Enums\ActivityStatuses;
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
        'status_id',
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
        'status_id'
    ];

    protected $appends = ['activity_type', 'status'];

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

    public function assignees()
    {
        return $this->belongsToMany(User::class, 'activity_assignees');
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

    /**
     * Get the activity's true status.
     *
     * @param  string  $value
     * @return string
     */
    public function getStatusAttribute()
    {
        return ActivityStatuses::getDescription($this->status_id);
    }
}
