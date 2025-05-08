<?php

namespace App\Http\Controllers;

use App\Models\Dishes;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDishesRequest;
use App\Http\Requests\UpdateDishesRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class DishesController extends Controller
{

    use WithPagination;

    public function index()
    {
        // ดึงข้อมูลจากโมเดล Dishes พร้อมกับข้อมูลจากความสัมพันธ์ (category) โดยเรียงลำดับจาก id ล่าสุด (desc) และแบ่งหน้า 5 รายการต่อหน้า
        $dishes = Dishes::with('category')->orderBy('id', 'desc')->paginate(5);

        // dd($dishes); // ใช้คำสั่ง dd() เพื่อตรวจสอบข้อมูลในตัวแปร $dishes 

        // ส่งข้อมูล $dishes ไปยัง view 'dishes.index' โดยใช้ฟังก์ชัน compact เพื่อให้ตัวแปร $dishes สามารถใช้งานใน view ได้
        return view('dishes.index', compact('dishes'));
    }




    public function create()
    {
        // ดึงข้อมูลทั้งหมดจากโมเดล Category 
        $categories = Category::all();

        // ส่งข้อมูล $categories ไปยัง view 'dishes.create'
        // โดยใช้ฟังก์ชัน compact เพื่อให้ตัวแปร $categories สามารถใช้งานใน view ได้
        return view('dishes.create',  compact('categories'));
    }


    public function store(StoreDishesRequest $request)
    {


        // ตรวจสอบและรับข้อมูลที่ผ่านการ validate แล้วจากฟอร์มที่ส่งมา
        $validated = $request->validated();

        // บันทึกข้อมูลเมนูอาหารใหม่ลงในฐานข้อมูล
        $dish = Dishes::create([
            'dish_name' => $validated['dish_name'],     // ตั้งชื่อเมนูจากค่าที่รับมา
            'price' => $validated['price'],             // กำหนดราคาจากค่าที่รับมา
            'category_id' => $validated['category_id'], // เชื่อมโยงกับประเภทเมนู (category)
        ]);

        // หลังจากบันทึกเสร็จ ให้ redirect ไปยังหน้าแสดงรายการเมนูอาหาร (dishes.index)
        // พร้อมกับส่งข้อความว่า "สร้างเมนูอาหารใหม่สำเร็จ"
        return redirect()->route('dishes.index')
            ->with('success', 'สร้างเมนูอาหารใหม่สำเร็จ');
    }


    public function show(Dishes $dish)
    {

        return view('dishes.show', compact('dish'));
    }

    public function edit(Dishes $dish)
    {
        return view('dishes.edit', compact('dish'));
    }

    public function update(Dishes $dish, UpdateDishesRequest $request)
    {
        // ดึงข้อมูลเดิมของเมนูจากฐานข้อมูลก่อนการอัปเดต
        $oldData = $dish->getOriginal();

        // ตรวจสอบและรับเฉพาะข้อมูลที่ผ่านการ validate จากแบบฟอร์ม
        $newData = $request->validated();

        // เปรียบเทียบความแตกต่างระหว่างข้อมูลใหม่กับข้อมูลเดิม
        $diff = array_diff($newData, $oldData);

        // อัปเดตข้อมูลเมนูในฐานข้อมูลด้วยข้อมูลใหม่
        $dish->update($newData);

        // ส่งกลับไปยังหน้ารายการเมนู พร้อมข้อความสำเร็จ และแสดงรายการข้อมูลที่ถูกแก้ไข
        return redirect()->route('dishes.index')
            ->with('success', 'แก้ไขข้อมูล [' .
                implode(', ', array_keys($diff)) . // แสดงชื่อฟิลด์ที่ถูกเปลี่ยน
                '] เป็น [' . implode(', ', $newData) . '] สำเร็จ'); // แสดงค่าที่เปลี่ยนใหม่
    }




    public function destroy(Dishes $dish)
    {


        $dish->delete();
        return redirect()->route('dishes.index')
            ->with('success', 'ลบ role สำเร็จ');
    }
}
