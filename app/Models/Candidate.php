<?php

namespace App\Models;

use App\Models\Industry;
use App\Models\JobFunction;
use App\Models\Scopes\Searchable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Authenticatable
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;
    use HasApiTokens;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'email',
        'phone',
        'gender_id',
        'dob',
        'headline',
        'country_id',
        'region_id',
        'city_id',
        'zip_code',
        'address',
        'photo',
        'summary',
        'resume',
        'skills',
        'industry_id',
        'job_function_id',
        'years_of_experience',

        'password',
        'reset_login',
        'first_login',
        'last_login',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'country_id',
        'region_id',
        'city_id',
        'industry_id',
        'job_function_id',
        'deleted_at'
    ];

    protected $with = [
        'city',
        'industry',
        'jobFunction',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'candidates';

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

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function jobFunction()
    {
        return $this->belongsTo(JobFunction::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
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
