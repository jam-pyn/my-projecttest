<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the Roles is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // กำหนดกฎสำหรับการ validate input
        // กฎเหล่านี้จะใช้ตรวจสอบว่า input ถูกต้องหรือไม่

        return [
            // ชื่อบทบาท
            'name' => [
                // จำเป็นต้องระบุ
                'required',
                // ต้องเป็น string
                'string',
            ],

            // รหัสบทบาท
            'email' => [
                // จำเป็นต้องระบุ
                'required',
                // ต้องเป็น string
                'string',
            ],

            
        ];
    }
}
