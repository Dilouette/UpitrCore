<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssesmentQuestionOption extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['assesment_question_id', 'is_answer'];

    protected $searchableFields = ['*'];

    protected $table = 'assesment_question_options';

    protected $casts = [
        'is_answer' => 'boolean',
    ];

    public function assesmentQuestion()
    {
        return $this->belongsTo(AssesmentQuestion::class);
    }

    public function assesmentResponses()
    {
        return $this->hasMany(AssesmentResponse::class);
    }
}
