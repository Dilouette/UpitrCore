<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\InvitationEmail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\UserCollection;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Api\ServiceController;

class UserController extends ServiceController
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

            $query = User::query()
                ->orderby('id', 'desc');

            $query->when($request->filled('keyword'), function ($q) use($request){
                return $q->where("email", "ilike", "%$request->keyword%")
                            ->orWhere("firstname", "ilike", "%$request->keyword%")
                            ->orWhere("lastname", "ilike", "%$request->keyword%");
            });

            $query->when($request->filled('department'), function ($q) use($request){
                return $q->where("department_id", $request->department);
            });

            if ($page_size != '*') {
                $users = $query->paginate($page_size);
            }
            
            return $this->success($users);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        } 
    }

    /**
     * @param \App\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $validated = $request->validated();

            $password = Hash::make(Str::random(10));
            $validated['password'] = $password;
            $validated['is_active'] = true;
            $validated['first_login'] = true;
            $validated['reset_login'] = false;

            $user = User::create($validated);

            $role = Role::findById($validated['role_id'] );

            if(!$role) {
                return $this->bad_request(null,'Selected role was not found');
            }

            $user->assignRole($role);

            $user = User::find($user->id);

            $role = $user->roles()->first()->makeHidden(['pivot', 'user_id', 'created_at', 'updated_at']);
            $permissions = $role->permissions->makeHidden(['pivot', 'guard_name', 'group_id', 'created_at', 'updated_at'])->load('group');
            
            $user->role = $role->load('user');
            $role->permissions = $permissions;

             // Send invitation mail
             try {
                Mail::to($validated["email"])->queue(new InvitationEmail($user, $password));
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }

            return $this->success($user);
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user  = User::find($id);
            if (!$user) {
                return $this->not_found();
            }

            $role = $user->roles()->first()->makeHidden(['pivot', 'user_id', 'created_at', 'updated_at']);
            $permissions = $role->permissions->makeHidden(['pivot', 'guard_name', 'group_id', 'created_at', 'updated_at'])->load('group');
            
            $user->role = $role->load('user');
            $role->permissions = $permissions;

            return $this->success(new UserResource($user));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }

    /**
     * @param \App\Http\Requests\UserUpdateRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $validated = $request->validated();

            $user  = User::find($id);
            if (!$user) {
                return $this->not_found();
            }

            $role_changed = $validated['role_id'] != $user->role_id;

            $user->update($validated);

            if ($role_changed) {
                $user->roles()->detach();
                $user->syncRoles([$validated['role_id']]);
            }            

            $role = $user->roles()->first()->makeHidden(['pivot', 'user_id', 'created_at', 'updated_at']);
            $permissions = $role->permissions->makeHidden(['pivot', 'guard_name', 'group_id', 'created_at', 'updated_at'])->load('group');
            
            $user->role = $role->load('user');
            $role->permissions = $permissions;

            return $this->success(new UserResource($user));
        } catch (\Throwable $th) {
            return $this->server_error($th);
        }        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user  = User::find($id);
            if (!$user) {
                return $this->not_found();
            }

            $user->delete();
            return $this->success();

        } catch (\Throwable $th) {
            return $this->server_error($th);
        }
    }
}
