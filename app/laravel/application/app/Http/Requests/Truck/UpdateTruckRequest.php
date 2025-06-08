<?php

namespace App\Http\Requests\Truck;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTruckRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'license_plate' => ['required', 'string', 'max:255', Rule::unique('trucks', 'license_plate')->ignore($this->route('truck')->id)],
            'name' => 'nullable|string|max:255',
        ];
    }
}
