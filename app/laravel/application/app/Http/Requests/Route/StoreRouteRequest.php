<?php

namespace App\Http\Requests\Route;

use App\Enums\Auth\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRouteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'driver_id' => ['required', 'integer', Rule::exists('users', 'id')->where(function ($query) {
                return $query
                    ->where('company_id', $this->user()->company_id)
                    ->where('role', Role::Driver);
            })],
            'truck_id' => ['required', 'integer', Rule::exists('trucks', 'id')->where(function ($query) {
                return $query
                    ->where('company_id', $this->user()->company_id);
            })],
            'start_date' => ['required', 'date', 'date_format:Y-m-d\TH:i'],
            'description' => ['nullable', 'string'],
        ];
    }
}
