<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:8'],
            'description' => ['required', 'string', 'min:20', 'max:250'],
            'surface' => ['required', 'integer', 'min:10'],
            'nmbRoom' => ['required', 'integer', 'min:1'],
            'nmbBedroom' => ['required', 'integer', 'min:0'],
            'floorCount' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:1'],
            'address' => ['required', 'string'],
            'zipCode' => ['required', 'string'],
            'sold' => ['required', 'boolean'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'options' => ['array', 'exists:options,id']
        ];
    }
}
