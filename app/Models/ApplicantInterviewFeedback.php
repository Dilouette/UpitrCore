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
        'inteview_question_id',
        'rating',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'applicant_interview_feedbacks';

    public function applicantInterview()
    {
        return $this->belongsTo(ApplicantInterview::class);
    }

    public function inteviewQuestion()
    {
        return $this->belongsTo(InteviewQuestion::class);
    }
}
