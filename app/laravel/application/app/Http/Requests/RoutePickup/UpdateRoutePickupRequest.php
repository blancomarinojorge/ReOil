<?php

namespace App\Http\Requests\RoutePickup;

use App\Enums\PickupState;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoutePickupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'delivery_note_notes' =>  'nullable|string|max:255',
            'observations' =>  'nullable|string|max:255',
            'state' => ['required',Rule::enum(PickupState::class)],
            'start_time' => ['nullable', 'date', 'date_format:Y-m-d\TH:i'],
            'end_time' => ['nullable', 'date', 'date_format:Y-m-d\TH:i'],
        ];
    }
}
