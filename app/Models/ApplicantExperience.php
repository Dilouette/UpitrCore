<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantExperience extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'title',
        'company',
        'industry_id',
        'summary',
        'start_date',
        'end_date',
        'job_applicant_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'applicant_experiences';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function jobApplicant()
    {
        return $this->belongsTo(JobApplicant::class);
    }
}
