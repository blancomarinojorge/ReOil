<?php

namespace App\Http\Controllers\Web\Auth;

use App\Enums\Auth\Role;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    public function create(){
        return view('auth.registration');
    }

    /**
     * Handles registration by creating a company and its admin user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        $attributes = $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userAttributes = [
            'email' => $attributes['email'],
            'password' => $attributes['password'],
        ];
        $companyName = $attributes['company'];

        /** @var User $user */
        $user = null;
        // we create the company and then the admin user for it, rollback if error
        try{
            DB::transaction(function () use (&$user,$userAttributes, $companyName) {
                $company = Company::create([
                    'name' => $companyName,
                ]);
                $user = $company->users()->create(array_merge($userAttributes, [
                    'name' => 'Admin',
                    'surname_1' => $company->name,
                    'role' => Role::Admin
                ]));
            }, 5);
        } catch (\Throwable $e) {
            Log::error('Registration failed. Email: '.$attributes['email'], [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()
                ->withInput()
                ->with('error', __('messages.registration_error'));
        }

        Auth::login($user);
        return redirect()->route('home');
    }
}
