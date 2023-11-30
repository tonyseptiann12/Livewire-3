<?php

namespace App\Livewire\Categories;

use Livewire\Attributes\Validate;
use App\Models\Category as Categories;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    #[Validate('required|min:3', onUpdate: false)]
    public $name = '';
    public $idCategory = '';
    public $updateForm = false;
    
    public function render()
    {        
        return view('livewire.categories.category', [
            'categories' => Categories::paginate(5)
        ]);
    }

    public function save(){
        $this->validate();
        Categories::create([
            'name' => $this->name,
            'slug' => \Str::slug($this->name)
        ]);

        $this->name = '';
    }

    public function edit($id){
        $category = Categories::findOrFail($id);
        $this->updateForm = true;
        $this->name = $category->name;
        $this->idCategory = $category->id;
    }

    public function update(){
        try {
            $this->validate();
            // Update category
            Categories::find($this->idCategory)->fill([
                'name' => $this->name,
                'slug' => \Str::slug($this->name),
            ])->save();
            $this->name = '';
            $this->updateForm = false;
        } catch (\Throwable $th) {
            $this->updateForm = false;
        }
    }

    public function destroy($id){
        Categories::find($id)->delete();
    }
}
