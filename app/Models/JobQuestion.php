<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobQuestion extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['job_id', 'question', 'job_question_type_id'];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'created_at',
        'updated_at', 
    ];

    protected $with = [
        'jobQuestionType',
        'jobQuestionOptions', 
    ];

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
