<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdateDishesRequest extends FormRequest
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
                'dish_name' => 'required|string|max:255',
                'price' => 'required|string|max:255',


        ];
    }

    public function messages()
    {
        return [
            'dish_name.required' => 'ชื่อจำเป็นต้องกรอก',
            'dish_name.string' => 'ชื่อต้องเป็นสตริง',
            'dish_name.max' => 'ชื่อต้องมีความยาวไม่เกิน 255 ตัวอักษร',
            'price.required' => 'รหัสจำเป็นต้องกรอก',
            'price.string' => 'รหัสต้องเป็นสตริง',
            'price.max' => 'รหัสต้องมีความยาวไม่เกิน 255 ตัวอักษร',
        ];
    }
}
