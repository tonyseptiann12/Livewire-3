<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class SearchBar extends Component
{
    public $search = '';

    public function render()
    {
        $data = [];
        if (strlen($this->search) > 1) {
            $data = Category::where('name', 'like', '%'.$this->search.'%')->get();
        }
        return view('livewire.search-bar', compact('data'));
    }
}
