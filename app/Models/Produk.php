<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $guarded = [];
    public $timestamps = false;

    public function kategori(){
        return $this->hasOne(Kategori::class, 'id_kategori', 'kategori_id');
    }
    
    public function status(){
        return $this->hasOne(Status::class, 'id_status', 'status_id');
    }
}
