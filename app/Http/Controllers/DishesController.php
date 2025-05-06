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


        // ใช้ Gate ตรวจสอบสิทธิ์การดู role
        // if (Gate::allows('viewAny', Roles::class)) {
        $dishes = Dishes::with('category')->orderBy('id', 'desc')->paginate(5);


        // dd($dishes);
        return view('dishes.index', compact('dishes'));
    }



    public function create()
    {

        $categories = Category::all();

        return view('dishes.create',  compact('categories'));
    }

    public function store(StoreDishesRequest $request)
    {


        $validated = $request->validated();

        // บันทึกข้อมูล dishes โดยการเชื่อมโยงกับ category_id ที่ส่งจากฟอร์ม
        $dish = Dishes::create([
            'dish_name' => $validated['dish_name'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'], // บันทึก category_id
        ]);

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
        // if (!Gate::allows('update', $role)) {
        //     return redirect()->route('roles.index')
        //         ->with('error', 'คุณไม่มีสิทธิในการแก้ไข Role นี้');
        // }

        $oldData = $dish->getOriginal();
        $newData = $request->validated();
        $diff = array_diff($newData, $oldData);
        $dish->update($newData);

        return redirect()->route('dishes.index')
            ->with('success', 'แก้ไขข้อมูล [' .
                implode(', ', array_keys($diff)) .
                '] เป็น [' . implode(', ', $newData) . '] สำเร็จ');
    }



    public function destroy(Dishes $dish)
    {
        // if (!Gate::allows('delete', $role)) {
        //     return redirect()->route('roles.index')
        //         ->with('error', 'คุณไม่มีสิทธิในการลบ Role นี้');
        // }

        $dish->delete();
        return redirect()->route('dishes.index')
            ->with('success', 'ลบ role สำเร็จ');
    }
}
