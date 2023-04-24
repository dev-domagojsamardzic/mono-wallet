<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PromotionPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => [ 'required', 'date'],
            'end_date' => [ 'required', 'date' ],
            'amount' => [ 'required', 'numeric', 'gt:0'],
            'quota' => [ 'required', 'integer', 'gt:0']
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
            'start_date.required' => 'The start date parameter is required.',
            'start_date.date' => 'The start date parameter must be a valid date.',
            'end_date.required' => 'The end date parameter is required.',
            'end_date.date' => 'The end date parameter must be a valid date.',
            'amount.required' => 'The amount parameter is required.',
            'amount.numeric' => 'The amount parameter must be a numeric value.',
            'amount.gt' => 'The amount parameter must be a numeric value greater than 0.',
            'quota.required' => 'The quota parameter is required.',
            'quota.integer' => 'The quota parameter should be an integer number.',
            'quota.gt' => 'The quota parameter must be an integer value greater than 0.'
        ];
    }
}
