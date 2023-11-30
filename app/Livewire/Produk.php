<?php

namespace App\Livewire;

use App\Models\Produk as ModelsProduk;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class Produk extends Component
{
    use WithPagination;

    #[Validate('required|min:3', onUpdate: false)]
    public $name = '';
    public $harga = '';
    public $id_kategori = '1';
    public $id_status = '1';
    public $idProduk = '';
    public $updateForm = false;

    public function render()
    {
        // $produke = ModelsProduk::with('kategori', 'status')->get();
        // dd($produke);
        return view('livewire.produk',[
            'produk' => ModelsProduk::with('kategori', 'status')->paginate(5)
        ]);
    }

    public function save(){
        // dd($this->id_kategori);
        $this->validate();
        ModelsProduk::create([
            'nama_produk'   => $this->name,
            'harga'         => $this->harga,
            'kategori_id'   => $this->id_kategori,
            'status_id'     => $this->id_status,
        ]);

        $this->name = '';
        $this->harga = '';
        $this->id_kategori = '';
        $this->id_status = '';
    }

    public function edit($id){
        $produk = ModelsProduk::where('id_produk', $id)->first();
        $this->updateForm = true;
        $this->name = $produk->nama_produk;
        $this->harga = $produk->harga;
        $this->status_id = $produk->status_id;
        $this->idProduk = $produk->id;
    }

    public function update(){
        try {
            $this->validate();
            // Update category
            ModelsProduk::where('id_produk', $this->idProduk)->update([
                'nama_produk'   => $this->name,
                'harga'         => $this->harga,
                'kategori_id'   => $this->id_kategori,
                'status_id'     => $this->id_status,
            ]);
            $this->name = '';
            $this->harga = '';
            $this->id_kategori = '';
            $this->id_status = '';
            $this->updateForm = false;
        } catch (\Throwable $th) {
            dd($th);
            $this->updateForm = false;
        }
    }

    public function destroy($id){
        ModelsProduk::where('id_produk', $id)->delete();
    }
}
