<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishesRequest extends FormRequest
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
            // ชื่อบทบาท
            'dish_name' => [
                // จำเป็นต้องระบุ
                'required',
                // ต้องเป็น string
                'string',
            ],
            'price' => [
                // จำเป็นต้องระบุ
                'required',
                // ต้องเป็น string
                'string',
            ],
            'category_id' => [
                // จำเป็นต้องระบุ
                'required',
                // ต้องเป็น string
                'string',
            ],




        ];
    }
}
