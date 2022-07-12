<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RoleStoreRequest;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Api\ServiceController;

class RoleController extends ServiceController {

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

            $query = Role::query()
                ->orderby('created_at', 'desc');

            $query->when($request->filled('keyword'), function ($q) use($request){
                return $q->where("title", "like", "%$request->keyword%");
            });

            $roles = $page_size == '*' ? $query->get() : $query->paginate($page_size);

            return $this->success($roles);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }      
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request) 
    {
        try {

            $validated = $request->validated();

            $validated['created_by'] = Auth::user()->id;
            $validated['web_guard'] = Auth::getDefaultDriver();

            $role = Role::create($validated);

            $permissions = Permission::find($request->permissions);
            $role->syncPermissions($permissions);
            
            $role->load('permissions');

            return $this->created(new RoleResource($role));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
        
    }

    /**
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        try {
            $role  = Role::find($id);
            if (!$role) {
                return $this->not_found();
            }

            $role->load('permissions');

            return $this->success(new RoleResource($role));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $validated = $this->validate($request, [
            'name'=>'required|max:32|unique:roles,name,'.$id,
            'permissions' =>'array',
        ]);
        try {
            $role  = Role::find($id);
            if (!$role) {
                return $this->not_found();
            }

            $role->update($validated);

            $permissions = Permission::find($request->permissions);
            $role->syncPermissions($permissions);

            $role->load('permissions');

            return $this->success(new RoleResource($role));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role  = Role::find($id);
            if (!$role) {
                return $this->not_found();
            }

            $role->delete();

            return $this->success();
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}