<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GetProductFromAPI extends Controller
{
    public function index()
    {
        $pw = 'bisacoding';
        $password = $pw."-".date('d-m-y');
        // dd($_SERVER['REQUEST_TIME']);
        $response = Http::asForm()->post('https://recruitment.fastprint.co.id/tes/api_tes_programmer', [
            'username' => 'tesprogrammer301123C10',
            'password' => md5($password),
        ])->json();
        // dd($response['data']);

        foreach ($response['data'] as $key => $value) {
            DB::beginTransaction();
            $kategori = Kategori::where('nama_kategori', $value['kategori'])->first();
            if(!$kategori){
                $kategori = Kategori::create(
                    ['nama_kategori' => $value['kategori']]
                );
            }
            $status = Status::where('nama_status', $value['status'])->first();
            if(!$status){
                $status = Status::create(
                    ['nama_status' => $value['status']]
                );
            }
            // dd($kategori->id_kategori);

            Produk::create([
                'nama_produk'   => $value['nama_produk'],
                'harga'         => $value['harga'],
                'kategori_id'   => $kategori->id_kategori,
                'status_id'     => $status->id_status,
            ]);
            DB::commit();
        }
    }
}
