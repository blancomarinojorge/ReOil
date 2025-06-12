<?php

namespace App\Http\Requests\Residue;

use App\Enums\Unit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateResidueRequest extends FormRequest
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
                Rule::unique('residues', 'name')
                    ->where('company_id', Auth::user()->company_id)
                    ->ignore($this->route('residue'))
            ],
            'unit' => ['required', 'string', Rule::enum(Unit::class)],
        ];
    }
}
