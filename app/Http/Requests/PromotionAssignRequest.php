<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionAssignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Although the authorization is done by using the 'auth:sanctum' middleware
        // Here too, I can authorize a user by doing something like this:
        return auth('sanctum')->user() !== false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => [ 'required', 'exists:promotions,code' ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'code.required' => 'The code parameter is required.',
            'code.exists' => 'Invalid promotion code'
        ];
    }
}
