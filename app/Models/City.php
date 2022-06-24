<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['region_id', 'name'];

    protected $searchableFields = ['*'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
