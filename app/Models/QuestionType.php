<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'question_types';

    public function jobQuestions()
    {
        return $this->hasMany(JobQuestion::class, 'job_question_type_id');
    }

    public function assesmentQuestions()
    {
        return $this->hasMany(AssesmentQuestion::class);
    }
}
