<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'nif' => 'nullable|string|max:255',
        ];
    }
}
