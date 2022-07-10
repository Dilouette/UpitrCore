<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantResponse extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'applicant_id',
        'job_question_id',
        'response',
        'job_question_option_id',
    ];

    protected $hidden = [
        'job_question_id',
        'job_question_option_id',
    ];

    protected $with = [
        'jobQuestion',
        'jobQuestionOption',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'applicant_responses';

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function jobQuestion()
    {
        return $this->belongsTo(JobQuestion::class);
    }

    public function jobQuestionOption()
    {
        return $this->belongsTo(JobQuestionOption::class);
    }
}
