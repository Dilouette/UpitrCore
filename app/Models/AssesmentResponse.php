<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssesmentResponse extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'applicant_assesment_id',
        'assesment_question_id',
        'response',
        'assesment_question_option_id',
    ];

    protected $searchableFields = ['*'];
    protected $table = 'assesment_responses';

    public function applicantAssesment()
    {
        return $this->belongsTo(ApplicantAssesment::class);
    }

    public function assesmentQuestion()
    {
        return $this->belongsTo(AssesmentQuestion::class);
    }

    public function assesmentQuestionOption()
    {
        return $this->belongsTo(AssesmentQuestionOption::class);
    }
}
