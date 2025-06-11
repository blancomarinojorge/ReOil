<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255',
                Rule::unique('clients', 'name')
                    ->where(function ($query) {$query->where('company_id', Auth::user()->company_id);})
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'latitude_longitude' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^-?\d{1,2}\.\d+,\s?-?\d{1,3}\.\d+$/'
            ],
        ];
    }
}
