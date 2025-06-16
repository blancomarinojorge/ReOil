<?php

namespace App\Http\Requests\RoutePickup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoutePickupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'client_id' => ['required', 'integer', 'exists:clients,id', Rule::notIn(
                $this->route('route')->pickups->pluck('client_id')->toArray()
            )],
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => __('The client field is required.'),
            'client_id.integer' => __('The client must be a valid ID.'),
            'client_id.exists' => __('The selected client does not exist.'),
            'client_id.not_in' => __('This client has already been added to the route.'),
        ];
    }
}
