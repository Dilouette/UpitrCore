<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicant extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'job_id',
        'candidate_id',
        'cover_letter',
        'job_workflow_stage_id',
        'interview_feedback',
        'interview_score',
        'assesment_score',
        'assesment_pass_score',
    ];

    protected $hidden = [
        'job_id',
        'candidate_id',
        'job_workflow_stage_id',
        'deleted_at'
    ];

    protected $with = [
        'candidate',
        'jobWorkflowStage', 
    ];

    protected $searchableFields = ['*'];

    protected $table = 'applicants';

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
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
