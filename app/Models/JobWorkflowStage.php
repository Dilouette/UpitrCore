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

    protected $searchableFields = ['*'];

    protected $table = 'job_workflow_stages';

    public function jobWorkflow()
    {
        return $this->belongsTo(JobWorkflow::class);
    }

    public function jobApplicants()
    {
        return $this->hasMany(JobApplicant::class);
    }
}
