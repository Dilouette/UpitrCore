<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssesmentQuestion extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'assesment_id',
        'question',
        'question_type_id',
        'answer',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'assesment_questions';

    public function assesment()
    {
        return $this->belongsTo(Assesment::class);
    }

    public function questionType()
    {
        return $this->belongsTo(QuestionType::class);
    }

    public function assesmentQuestionOptions()
    {
        return $this->hasMany(AssesmentQuestionOption::class);
    }

    public function assesmentResponses()
    {
        return $this->hasMany(AssesmentResponse::class);
    }
}
