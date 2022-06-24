<?php

namespace App\Http\Controllers\Api;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class DesignationUsersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Designation $designation)
    {
        $this->authorize('view', $designation);

        $search = $request->get('search', '');

        $users = $designation
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Designation $designation
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Designation $designation)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'email' => ['required', 'unique:users,email', 'email'],
            'username' => ['required', 'max:255', 'string'],
            'firstname' => ['required', 'max:255', 'string'],
            'lastname' => ['required', 'max:255', 'string'],
            'department_id' => ['nullable', 'numeric', 'exists:departments,id'],
            'password' => ['required'],
            'reset_login' => ['required', 'boolean'],
            'first_login' => ['required', 'boolean'],
            'last_login' => ['required', 'date'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $designation->users()->create($validated);

        return new UserResource($user);
    }
}
