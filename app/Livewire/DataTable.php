<?php

namespace App\Livewire;

use Livewire\Component; // นำเข้า Livewire\Component เพื่อใช้สร้าง component ของ Livewire
use App\Models\Roles as ModelsRoles; // นำเข้าโมเดล Roles จาก App\Models และตั้งชื่อว่า ModelsRoles เพื่อให้ใช้งานสะดวก

class DataTable extends Component // สร้าง class DataTable ที่ extends จาก Livewire\Component เพื่อสร้าง Livewire Component
{
    // ฟังก์ชัน render ที่จะใช้ในการแสดงผลข้อมูล
    public function render()
    {
        // ดึงข้อมูลทั้งหมดจากตาราง roles ในฐานข้อมูล โดยใช้โมเดล ModelsRoles
        $roles = ModelsRoles::all();

        // ส่งข้อมูล $roles ไปยัง view 'livewire.data-table' ซึ่งจะแสดงผลในหน้าเว็บ
        return view('livewire.data-table', [
            //'roles': คีย์ที่ใช้ส่งข้อมูลจากคอมโพเนนต์ไปยัง view.

            // ส่งข้อมูล roles ไปยัง view ในตัวแปร $roles
            'roles' => $roles,
        ]);
    }
}
