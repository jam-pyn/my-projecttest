<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolesRequest extends FormRequest
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
            'role_name' => [
                // จำเป็นต้องระบุ
                'required',
                // ต้องเป็น string
                'string',
            ],

            // รหัสบทบาท
            'role_code' => [
                // จำเป็นต้องระบุ
                'required',
                // ต้องเป็น string
                'string',
            ],

            // คำอธิบาย
            'description' => [
                // ไม่จำเป็น
                'nullable',
                // ต้องเป็น string
                'string',
            ],
        ];
    }
}
