<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class DepartmentUsersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Department $department)
    {
        $this->authorize('view', $department);

        $search = $request->get('search', '');

        $users = $department
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Department $department)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'email' => ['required', 'unique:users,email', 'email'],
            'username' => ['required', 'max:255', 'string'],
            'firstname' => ['required', 'max:255', 'string'],
            'lastname' => ['required', 'max:255', 'string'],
            'password' => ['required'],
            'reset_login' => ['required', 'boolean'],
            'first_login' => ['required', 'boolean'],
            'last_login' => ['required', 'date'],
            'designation_id' => [
                'nullable',
                'numeric',
                'exists:designations,id',
            ],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $department->users()->create($validated);

        return new UserResource($user);
    }
}
