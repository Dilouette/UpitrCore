<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantInterview extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'job_applicant_id',
        'score',
        'feedback',
        'start_time',
        'end_time',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'applicant_interviews';

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function jobApplicant()
    {
        return $this->belongsTo(JobApplicant::class);
    }

    public function applicantInterviewFeedbacks()
    {
        return $this->hasMany(ApplicantInterviewFeedback::class);
    }
}
