<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobWorkflow extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'is_system_workflow'];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'created_at',
        'updated_at', 
        'deleted_at', 
    ];

    protected $table = 'job_workflows';

    protected $casts = [
        'is_system_workflow' => 'boolean',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function jobWorkflowStages()
    {
        return $this->hasMany(JobWorkflowStage::class);
    }
}
