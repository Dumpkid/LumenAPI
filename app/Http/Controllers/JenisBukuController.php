<?php

namespace App\Http\Controllers;
use App\Models\Jenis_Buku;
use Illuminate\Http\Request;

class JenisBukuController extends Controller
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
        $jenisbuku = Jenis_Buku::all();
        $count = $jenisbuku->count();
        if ($count >= 1){
            return response([
                'success' => true,
                'message' => 'Data Jenis Buku',
                'data' => $jenisbuku
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data Jenis Buku Kosong',
                'data' => ''
            ],404);
        }
    }

    public function showId($id)
    {
        $jenisbuku = Jenis_Buku::find($id);

        if($jenisbuku){
            return response([
                'success' => true,
                'message' => 'Data ditemukan!',
                'data' => $jenisbuku
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
        $jenis_buku = $request->input('jenis_buku');

        $cek_jenis_buku = Jenis_Buku::where('jenis_buku',$jenis_buku)->first();
        if ($cek_jenis_buku){
            return response([
                'Success' => false,
                'message' => 'Jenis Buku sudah terdaftar'
            ],400);
        }else {
            $tambah = Jenis_Buku::create([
                'jenis_buku' => $jenis_buku,
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
        $jenis_buku = Jenis_Buku::where('id_jenis', $id)->first();
        if (!$jenis_buku) {
            return response([
            'success' => false,
            'message' => 'Data tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $jenis_buku->update($input);
            return response([
                'success' => true,
                'message' => 'Update berhasil',
                'data' => $jenis_buku,
            ],201);
        }
        
    }

    public function delete($id)
    {
        $jenis_buku = Jenis_Buku::find($id);
        if ($jenis_buku){
            $hapus = $jenis_buku->delete();
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
