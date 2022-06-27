<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentCollection;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends ServiceController
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $search = $request->get('search', '');
            $departments = Department::search($search)
                ->latest()
                ->orderby('id')
                ->paginate();
            $departments->makeHidden(['created_by']);
            return $this->success(new DepartmentCollection($departments));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\DepartmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentStoreRequest $request)
    {
        try {
            $user = Auth::user();

            Log::debug($user);
            
            $validated = $request->validated();

            if ($validated['created_by'] != $user->id) {
                return $this->bad_request(null, null, 'user_mismatch');
            }

            $department = Department::create($validated);

            $department->load('user');
            $department->makeHidden(['created_by']);

            return $this->created(new DepartmentResource($department));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $department  = Department::find($id);
            if (!$department) {
                return $this->not_found();
            }

            $department->load('user');
            $department->makeHidden(['created_by']);

            return $this->success(new DepartmentResource($department));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\DepartmentUpdateRequest $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentUpdateRequest $request, $id)
    {
        try {
            $department  = Department::find($id);
            if (!$department) {
                return $this->not_found();
            }
            $validated = $request->validated();

            $validated['updated_at'] = Carbon::now();

            $department->update($validated);

            $department->load('user');
            $department->makeHidden(['created_by']);

            return $this->success(new DepartmentResource($department));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $department  = Department::find($id);
            if (!$department) {
                return $this->not_found();
            }

            $department->delete();
            return $this->success();

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
