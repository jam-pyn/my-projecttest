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
            'dishes' => ModelsDishes::with('category')->search(['dish_name', 'price','category.category'], $this->search, 'contains', 'or')->paginate(5),

        ]);

    }
}
