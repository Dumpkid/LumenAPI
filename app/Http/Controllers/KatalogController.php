<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show()
    {
        $katalog = Katalog::all();
        $count = $katalog->count();
        if ($count >= 1){
            return response([
                'success' => true,
                'message' => 'Data Katalog',
                'data' => $katalog
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data Katalog Kosong',
                'data' => ''
            ],404);
        }
    }

    public function showId($id)
    {
        $katalog = Katalog::find($id);

        if($katalog){
            return response([
                'success' => true,
                'message' => 'Data ditemukan!',
                'data' => $katalog
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data tidak ditemukan!',
                'data' => ''
            ],404);
        }
    }

    public function create(Request $request)
    {
        $id_buku = $request->input('id_buku');
        $id_pinjam = $request->input('id_pinjam');
        $id_rak = $request->input('id_rak');

        $cek_katalog = Katalog::where('id_buku',$id_buku)->first();
        if ($cek_katalog){
            return response([
                'Success' => false,
                'message' => 'Buku sudah terdaftar di Katalog!'
            ],400);
        }else {
            $tambah = Katalog::create([
                'id_buku' => $id_buku,
                'id_pinjam' => $id_pinjam,
                'id_rak' => $id_rak,
            ]);
    
            if ($tambah){
                return response([
                    'Success' => true,
                    'message' => 'Data berhasil ditambahkan!'
                ],201);
            } else {
                return response([
                    'Success' => false,
                    'message' => 'Gagal menambah data!'
                ],400);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $katalog = Katalog::where('id_katalog', $id)->first();
        if (!$katalog) {
            return response([
            'success' => false,
            'message' => 'Data tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $katalog->update($input);
            return response([
                'success' => true,
                'message' => 'Update berhasil',
                'data' => $katalog,
            ],201);
        }
        
    }

    public function delete($id)
    {
        $katalog = Katalog::find($id);
        if ($katalog){
            $hapus = $katalog->delete();
            if($hapus){
                return response([
                    'Success' => true,
                    'message' => 'Data berhasil dihapus!',
                    'data' => ''
                ],200);
            }
        } else {
            return response([
                'Success' => false,
                'message' => 'Data tidak ditemukan!',
                'data' => ''
            ],404);
        }
    }
}
