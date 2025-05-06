<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Roles as ModelsRoles;


class DataTable extends Component

{
    public function render()
    {

        // ดึงข้อมูล Roles ทั้งหมด
        $roles = ModelsRoles::all();

        return view('livewire.data-table', [
            'roles' => $roles,


        ]);

    }
}
