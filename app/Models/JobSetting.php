<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobSetting extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'job_id',
        'firstname',
        'lastname',
        'email',
        'phone',
        'heading',
        'address',
        'photo',
        'education',
        'experience',
        'summary',
        'resume',
        'cover_letter',
        'cv',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'job_settings';

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
