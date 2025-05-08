<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    // ใช้ฟีเจอร์ของ Laravel ที่ชื่อว่า HasFactory ซึ่งช่วยให้สามารถสร้างข้อมูลตัวอย่างได้
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    // กำหนดค่าในฟิลด์ 'category' เป็นฟิลด์ที่สามารถถูกกำหนดค่าได้แบบ mass assignment
    protected $fillable = [
        'category',
    ];

    // กำหนดตัวแปร categories ซึ่งจะเก็บข้อมูลทั้งหมดของ category
    public $categories = [];

    // ฟังก์ชัน mount จะถูกเรียกใช้เพื่อดึงข้อมูลทั้งหมดของ Category มาเก็บใน $categories
    public function mount()
    {
        // ดึงข้อมูลทุกแถวจากตาราง categories และเก็บไว้ในตัวแปร $categories
        $this->categories = Category::all();
    }
}
