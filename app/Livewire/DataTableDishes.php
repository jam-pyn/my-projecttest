<?php

namespace App\Livewire;

use App\Models\Category;

use Livewire\Component;

class DataTableDishes extends Component
{
    // ฟังก์ชัน render จะถูกใช้เพื่อเตรียมข้อมูลที่จะแสดงใน view
    public function render()
    {
        // ดึงข้อมูลทั้งหมดจากตารางโดยใช้โมเดล Category และเก็บผลลัพธ์ในตัวแปร $categorys
        $categorys = Category::all();


        // ส่งข้อมูลไปยัง view 'livewire.data-table-dishes'
        return view('livewire.data-table-dishes', [

            // ส่งตัวแปร $categorys ไปยัง view โดยใช้คีย์ 'categorys'
            'categorys' => $categorys,
        ]);
    }
}
