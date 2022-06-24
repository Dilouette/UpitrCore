<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InteviewQuestion extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['interview_section_id', 'question', 'title'];

    protected $searchableFields = ['*'];

    protected $table = 'inteview_questions';

    public function interviewSection()
    {
        return $this->belongsTo(InterviewSection::class);
    }

    public function applicantInterviewFeedbacks()
    {
        return $this->hasMany(ApplicantInterviewFeedback::class);
    }
}
