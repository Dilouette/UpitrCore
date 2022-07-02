<?php

namespace App\Models;

use App\Models\InterviewSection;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interview extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['job_id', 'title', 'type_id'];

    protected $searchableFields = ['*'];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function interviewSections()
    {
        return $this->hasMany(InterviewSection::class);
    }
}
