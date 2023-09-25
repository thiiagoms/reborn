<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreSiteRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'url',
                'max:150',
                Rule::unique('sites')->where('user_id', Auth::user()->id)
            ],
            'description' => [
                'sometimes'
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'You must submit a URL',
            'name.url' => 'You must submit a valid URL'
        ];
    }
}
