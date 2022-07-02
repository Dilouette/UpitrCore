<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InterviewSection extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'questions', 'interview_id'];

    protected $searchableFields = ['*'];

    protected $table = 'interview_sections';

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function inteviewQuestions()
    {
        return $this->hasMany(InteviewQuestion::class);
    }
}
