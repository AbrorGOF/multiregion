<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDistrictRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:districts,name',
            'region_id' => 'nullable|integer|exists:regions,id',
            'country_id' => 'nullable|integer|exists:countries,id',
        ];
    }
}
