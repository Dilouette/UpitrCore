<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\PermissionGroup;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;

class PermissionController extends ServiceController
{
    /**
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        try {

            $query = PermissionGroup::query()
                ->orderby('created_at', 'desc');

            $query->when($request->filled('keyword'), function ($q) use($request){
                return $q->where("title", "like", "%$request->keyword%");
            });

            $groups = $query->get();
            return $this->success($groups);

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }     
    }

    /**
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->authorize('create', Permission::class);

        $validated = $this->validate($request, [
            'name' => 'required|max:64',
            'roles' => 'array'
        ]);

        $permission = Permission::create($validated);
        
        $roles = Role::find($request->roles);
        $permission->syncRoles($roles);

        return new PermissionResource($permission);
    }

    /**
    * @param  \Spatie\Permission\Models\Permission  $permission
    * @return \Illuminate\Http\Response
    */
    public function show(Permission $permission)
    {
        $this->authorize('view', Permission::class);

        return new PermissionResource($permission);
    }

    /**
    * @param  \Illuminate\Http\Request  $request
    * @param  \Spatie\Permission\Models\Permission  $permission
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $validated = $this->validate($request, [
            'name' => 'required|max:40',
            'roles' => 'array'
        ]);

        $permission->update($validated);
        
        $roles = Role::find($request->roles);
        $permission->syncRoles($roles);

        return new PermissionResource($permission);
    }

    /**
    * @param  \Spatie\Permission\Models\Permission  $permission
    * @return \Illuminate\Http\Response
    */
    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);

        $permission->delete();

        return response()->noContent();
    }
}
