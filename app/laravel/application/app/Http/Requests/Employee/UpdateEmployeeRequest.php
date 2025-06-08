<?php

namespace App\Http\Requests\Employee;

use App\Enums\Auth\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //ignore the email check of the current user being updated
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users', 'email')->ignore($this->route('user')->id),
                /// i could go and make the email be able to repeat between different companies, but too much work, i'll have to divide the app links by company subdomain, or have the user pick the company they are from in the login. Maybe later...
                //Rule::unique('users', 'email')->where(function ($query) { return $query->where('company_id', Auth::user()->company_id); })
            ],
            'name' => ['required', 'string', 'max:255'],
            'surname_1' => ['required', 'string', 'max:255'],
            'surname_2' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'dni' => ['nullable', 'string', 'size:9'],
            'company_phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', new Enum(Role::class)],
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            'dni' => strtoupper($this->dni)
        ]);
    }
}
