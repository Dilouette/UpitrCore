<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobQuestionOption extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['option', 'job_question_id'];

    protected $searchableFields = ['*'];

    protected $table = 'job_question_options';

    public function jobQuestion()
    {
        return $this->belongsTo(JobQuestion::class);
    }

    public function applicantResponses()
    {
        return $this->hasMany(ApplicantResponse::class);
    }
}
