<?php

namespace App\Http\Requests\ContainerType;

use App\Enums\Unit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateContainerTypeRequest extends FormRequest
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
            'capacity' => 'required|numeric|min:1',
            'unit' => ['required', Rule::enum(Unit::class)],
            'un_code' => ['nullable', 'string', 'max:255',
                Rule::unique('container_types', 'un_code')->where(function ($query) {
                    $query->where('company_id', Auth::user()->company_id);
                })->ignore($this->route('container_type')->id)
            ],
            'length_cm' => 'nullable|required_with:width_cm,height_cm|numeric|min:1',
            'width_cm' => 'nullable|required_with:length_cm,height_cm|numeric|min:1',
            'height_cm' => 'nullable|required_with:length_cm,width_cm|numeric|min:1',
        ];
    }
}
