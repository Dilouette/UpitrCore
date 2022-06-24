<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'code', 'phone_code', 'flag'];

    protected $searchableFields = ['*'];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
