<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantInterviewFeedback extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'applicant_interview_id',
        'interview_section_id',
        'rating',
    ];

    protected $hidden = ['deleted_at', 'interview_section_id', 'applicant_interview_id'];

    protected $with = ['interviewSection'];

    protected $searchableFields = ['*'];

    protected $table = 'applicant_interview_feedbacks';

    public function applicantInterview()
    {
        return $this->belongsTo(ApplicantInterview::class);
    }

    public function interviewSection()
    {
        return $this->belongsTo(InterviewSection::class);
    }
}
