<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobWorkflowStage extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'order',
        'stage_type_id',
        'job_workflow_id',
    ];

    protected $hidden = [        
        "stage_type_id",
        "job_workflow_id",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    protected $searchableFields = ['*'];

    protected $table = 'job_workflow_stages';

    public function jobWorkflow()
    {
        return $this->belongsTo(JobWorkflow::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}
