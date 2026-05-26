<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'phone' => [
                'required',
                'string',
                'unique:users,phone',
            ],

            'shop_name' => ['required'],

            'city_area' => ['required'],

            'photo' => [
                'nullable',
                'image',
                'max:2048',
            ],

            'pin' => [
                'required',
                'digits:4',
                'confirmed',
            ],

            'device_id' => [
                'required',
                'string',
            ],
        ];
    }
}
