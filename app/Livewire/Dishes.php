<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Dishes as ModelsDishes;
use Livewire\Component;
use Livewire\WithPagination;

class Dishes extends Component
{
    use WithPagination;

    // public function render()
    // {
    //     $dishes = ModelsDishes::paginate(5);

    //     return view('livewire.dishes', [
    //         'dishes' => $dishes,
    //     ]);
    // }

    public $search = '';

    // public $message = 'helloworld';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // $dishes = ModelsDishes::paginate(5);


        return view('livewire.dishes', [
            // ดึงข้อมูลจากโมเดล ModelsDishes พร้อมกับข้อมูลที่เกี่ยวข้องจากตาราง 'category' ด้วยการใช้ with()
            'dishes' => ModelsDishes::with('category')

                //เลือกให้ค้นหาตรงแบบ 'contains' หรือ 'or'
                ->search(['dish_name', 'price', 'category.category'], $this->search, 'contains', 'or')

                ->paginate(5), // แบ่งหน้าแสดงผลข้อมูล dishes 5 รายการต่อหน้า
        ]);
    }
}
