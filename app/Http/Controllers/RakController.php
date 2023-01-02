<?php

namespace App\Http\Controllers;
use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
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
        $rak = Rak::all();
        $count = $rak->count();
        if ($count >= 1){
            return response([
                'success' => true,
                'message' => 'Data Rak',
                'data' => $rak
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data Rak Kosong',
                'data' => ''
            ],404);
        }
    }

    public function showId($id)
    {
        $rak = Rak::find($id);

        if($rak){
            return response([
                'success' => true,
                'message' => 'Data ditemukan!',
                'data' => $rak
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
        $nama_rak = $request->input('nama_rak');
        $lokasi_rak = $request->input('lokasi_rak');
        $id_buku = $request->input('id_buku');

        $cek_rak = Rak::where('nama_rak',$nama_rak)->first();
        if ($cek_rak){
            return response([
                'Success' => false,
                'message' => 'Rak sudah terdaftar'
            ],400);
        }else {
            $tambah = Rak::create([
                'nama_rak' => $nama_rak,
                'lokasi_rak' => $lokasi_rak,
                'id_buku' => $id_buku,
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
        $rak = Rak::where('id_rak', $id)->first();
        if (!$rak) {
            return response([
            'success' => false,
            'message' => 'Data tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $rak->fill($input);
            return response([
                'success' => true,
                'message' => 'Update berhasil',
                'data' => $rak,
            ],201);
        }
        
    }

    public function delete($id)
    {
        $rak = Rak::find($id)->delete();
        if ($rak){
            return response([
                'Success' => true,
                'message' => 'Data berhasil dihapus!',
                'data' => ''
            ],200);
        } else {
            return response([
                'Success' => false,
                'message' => 'Gagal menghapus data!',
                'data' => ''
            ],404);
        }
        
    }
}
