<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InterviewSection extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'interview_id'];

    protected $with = ['interviewQuestions'];

    protected $searchableFields = ['*'];

    protected $table = 'interview_sections';

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function interviewQuestions()
    {
        return $this->hasMany(InterviewQuestion::class);
    }
}
