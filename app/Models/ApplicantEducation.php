<?php

namespace App\Models;

use App\Enums\DegreeClassification;
use App\Models\Scopes\Searchable;
use Attribute;
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
        'degree_classification_id',
        'start_date',
        'end_date',
        'job_applicant_id',
    ];

    protected $appends = ['degree_classification'];

    protected $hidden = ['degree_classification_id'];

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

     /**
     * Get the applicants's true degree class.
     *
     * @param  string  $value
     * @return string
     */
    public function getDegreeClassificationAttribute()
    {
        return DegreeClassification::getDescription($this->degree_classification_id);
    }
}
