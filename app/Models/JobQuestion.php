<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobQuestion extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['job_id', 'question', 'job_question_type_id'];

    protected $searchableFields = ['*'];

    protected $table = 'job_questions';

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function jobQuestionType()
    {
        return $this->belongsTo(QuestionType::class, 'job_question_type_id');
    }

    public function jobQuestionOptions()
    {
        return $this->hasMany(JobQuestionOption::class);
    }

    public function applicantResponses()
    {
        return $this->hasMany(ApplicantResponse::class);
    }
}
