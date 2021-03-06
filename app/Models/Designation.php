<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Designation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description', 'created_by'];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'created_at',
        'updated_at', 
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
