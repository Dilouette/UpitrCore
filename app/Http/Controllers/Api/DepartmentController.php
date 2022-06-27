<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            $page_size = env('DEFAULT_PAGE_SIZE');

            if ($request->filled('page_size')) {
                $page_size = $request->page_size;
            }            
            $query = Department::query()
                ->orderby('id', 'desc');

            $departments = $query->paginate($page_size);

            return $this->success($departments);
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

            $validated = $request->validated();

            $validated['created_by'] = $user->id;

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
