<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'code',
        'country_id',
        'region_id',
        'city_id',
        'zip_code',
        'location',
        'is_remote',
        'description',
        'requirements',
        'benefit',
        'department_id',
        'industry_id',
        'job_function_id',
        'employment_type_id',
        'experience_level_id',
        'education_level_id',
        'keywords',
        'salary_min',
        'salary_max',
        'salary_currency_id',
        'head_count',
        'created_by',
        'is_published',
        'deadline',
        'job_workflow_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'is_remote' => 'boolean',
        'is_published' => 'boolean',
        'deadline' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'salary_currency_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplicant::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function jobFunction()
    {
        return $this->belongsTo(JobFunction::class);
    }

    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function experienceLevel()
    {
        return $this->belongsTo(ExperienceLevel::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function jobQuestions()
    {
        return $this->hasMany(JobQuestion::class);
    }

    public function jobSettings()
    {
        return $this->hasMany(JobSetting::class);
    }

    public function jobWorkflow()
    {
        return $this->belongsTo(JobWorkflow::class);
    }

    public function assesments()
    {
        return $this->hasMany(Assesment::class);
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
