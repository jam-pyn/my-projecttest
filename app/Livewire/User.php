<?php

namespace App\Livewire; // กำหนด namespace ของ component นี้

use App\Models\User as ModelsUser; // นำเข้าโมเดล User จาก App\Models
use Livewire\Component; // นำเข้า Livewire\Component เพื่อใช้สร้าง component ของ Livewire
use Livewire\WithPagination; // นำเข้า trait สำหรับเพิ่มฟังก์ชันการแบ่งหน้า

class User extends Component // สร้าง class User ที่ extends จาก Livewire\Component
{
    use WithPagination; 

    public $search = ''; // กำหนดตัวแปร search สำหรับการค้นหาผู้ใช้

    // public $message = 'helloworld'; 

    // ฟังก์ชันนี้จะถูกเรียกเมื่อมีการอัพเดตค่าของ search
    public function updatingSearch()
    {
        $this->resetPage(); // รีเซ็ตหน้าปัจจุบันให้กลับไปที่หน้าที่ 1 เมื่อทำการค้นหาใหม่
    }

    // ฟังก์ชัน render เพื่อแสดงผลของ component
    public function render()
    {
        return view('livewire.user', [ 
            //'users' คือคีย์ที่ใช้ส่งข้อมูลจาก controller ไปยัง view ใน Laravel โดยตัวแปร $users จะเป็นค่าที่เก็บข้อมูลที่เราต้องการส่ง
            
            'users' => ModelsUser::query() // สร้าง query เพื่อดึงข้อมูลจากฐานข้อมูล 

            //=> ใช้ในการเชื่อมโยงคีย์และค่าในอาร์เรย์ใน PHP.
                ->search(['name', 'email'], $this->search, 'contains', 'or') // ใช้ search scope สำหรับค้นหาจากชื่อและอีเมล
                ->paginate(5), // แบ่งหน้าแสดงข้อมูลผู้ใช้ 5 คนต่อหน้า
        ]);
    }
}
