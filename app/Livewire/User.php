<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    public $search = '';

    // public $message = 'helloworld';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.user', [
            'users' => ModelsUser::query()
                ->search(['name', 'email'], $this->search, 'contains', 'or')
                ->paginate(5),
        ]);
    }
}
