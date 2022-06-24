<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantEducation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'institution',
        'field',
        'degree',
        'start_date',
        'end_date',
        'job_applicant_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'applicant_educations';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function jobApplicant()
    {
        return $this->belongsTo(JobApplicant::class);
    }
}
