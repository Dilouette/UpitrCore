<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['country_id', 'name'];

    protected $hidden =[
        'country_id',
        'created_at',
        'update_at',             
    ];

    protected $with = ['country'];

    protected $searchableFields = ['*'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
