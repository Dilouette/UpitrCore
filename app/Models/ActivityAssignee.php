<?php

namespace App\Models;

use App\Enums\ActivityTypes;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityAssignee extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'activity_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class);
    }
}
