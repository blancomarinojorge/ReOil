<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('company')
            ->where('users.company_id', Auth::user()->company_id)
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('employees.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        return $this->tryAction(
            fn() => [
                User::create(array_merge(
                    $request->only('name', 'dni', 'email', 'surname_1', 'surname_2', 'phone', 'company_phone','role'),
                    [
                        'password' => Hash::make('abc123..'),
                        'company_id' => Auth::user()->company_id
                    ]
                ))
            ],
            __('messages.employee_creation_success'),
            __('messages.employee_creation_error'),
            route('employees.index')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('employees.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('employees.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, User $user)
    {
        return $this->tryAction(
            fn() => [
                $user->update(
                    $request->only('name', 'dni', 'email', 'surname_1', 'surname_2', 'phone', 'company_phone','role')
                )
            ],
            __('messages.employee_update_success'),
            __('messages.employee_update_error'),
            route('employees.show', $user->id)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $this->tryAction(
            fn() => $user->delete(),
            __('messages.employee_deletion_success'),
            __('messages.employee_deletion_error'),
            route('employees.index')
        );
    }
}
