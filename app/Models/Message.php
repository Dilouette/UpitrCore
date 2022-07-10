<?php

namespace App\Models;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'from_user_type_id',
        'to_user_type_id',
        'subject',
        'body',
        'user_id',
        'candidate_id',
        'reply_to',
        'opened'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function parent()
    {
        return $this->belongsTo(Message::class, 'reply_to');
    }

    
}
