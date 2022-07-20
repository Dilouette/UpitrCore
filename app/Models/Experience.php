<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
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
        'candidate_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'experiences';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    protected $with = [
        'industry'
    ];

    protected $hidden = [
        'industry_id'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
