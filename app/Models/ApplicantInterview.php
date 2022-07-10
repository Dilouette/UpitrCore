<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantInterview extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'applicant_id',
        'interview_id',
        'score',
        'feedback',
        'start_time',
        'end_time',
        'created_by',
    ];

    protected $hidden = ['deleted_at', 'interview_id'];

    protected $with = ['interview'];

    protected $searchableFields = ['*'];

    protected $table = 'applicant_interviews';

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function interview()
    {
        return $this->belongsTo(Interview::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function applicantInterviewFeedbacks()
    {
        return $this->hasMany(ApplicantInterviewFeedback::class);
    }
}
