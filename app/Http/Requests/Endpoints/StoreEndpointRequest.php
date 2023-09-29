<?php

namespace App\Http\Requests\Endpoints;

use Illuminate\Foundation\Http\FormRequest;

class StoreEndpointRequest extends FormRequest
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
            'name'               => ['required', 'string', 'max:150'],
            'http'               => ['required', 'integer'],
            'frequency'          => ['required', 'integer'],
            'frequency_interval' => ['required', 'integer'],
            'payload'            => ['sometimes']
        ];
    }
}
