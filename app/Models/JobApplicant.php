<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplicant extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'job_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'headline',
        'address',
        'photo',
        'summary',
        'resume',
        'cover_letter',
        'cv',
        'job_workflow_stage_id',
        'consideration_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'job_applicants';

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function applicantExperiences()
    {
        return $this->hasMany(ApplicantExperience::class);
    }

    public function applicantEducations()
    {
        return $this->hasMany(ApplicantEducation::class);
    }

    public function jobWorkflowStage()
    {
        return $this->belongsTo(JobWorkflowStage::class);
    }

    public function applicantResponses()
    {
        return $this->hasMany(ApplicantResponse::class);
    }

    public function applicantAssesments()
    {
        return $this->hasMany(ApplicantAssesment::class);
    }

    public function applicantInterviews()
    {
        return $this->hasMany(ApplicantInterview::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
