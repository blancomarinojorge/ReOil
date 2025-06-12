<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateContainerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'observations' => 'nullable|string|max:255',
            'container_type_id' => ['required', 'integer',
                Rule::exists('container_types', 'id')->where(function ($query) {
                    return $query->where('company_id', Auth::user()->company_id);
                })
            ],
            'client_id' => ['required', 'integer',
                Rule::exists('clients', 'id')->where(function ($query) {
                    return $query->where('company_id', Auth::user()->company_id);
                })
            ],
        ];
    }
}
