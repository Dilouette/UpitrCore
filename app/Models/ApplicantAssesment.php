<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantAssesment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'job_applicant_id',
        'status_id',
        'score',
        'start_time',
        'end_time',
        'ip',
        'user_agent',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'applicant_assesments';

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function jobApplicant()
    {
        return $this->belongsTo(JobApplicant::class);
    }

    public function assesmentResponses()
    {
        return $this->hasMany(AssesmentResponse::class);
    }
}
