<?php

namespace App\Http\Controllers;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
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
        $penerbit = Penerbit::all();
        $count = $penerbit->count();
        if ($count >= 1){
            return response([
                'success' => true,
                'message' => 'Data Penerbit',
                'data' => $penerbit
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data Penerbit Kosong',
                'data' => ''
            ],404);
        }
    }

    public function showId($id)
    {
        $penerbit = Penerbit::find($id);

        if($penerbit){
            return response([
                'success' => true,
                'message' => 'Data ditemukan!',
                'data' => $penerbit
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
        $nama_penerbit = $request->input('nama_penerbit');
        $kota = $request->input('kota');

        $cek_penerbit = Penerbit::where('nama_penerbit',$nama_penerbit)->first();
        if ($cek_penerbit){
            return response([
                'Success' => false,
                'message' => 'Penerbit sudah terdaftar'
            ],400);
        }else {
            $tambah = Penerbit::create([
                'nama_penerbit' => $nama_penerbit,
                'kota' => $kota,
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
        $penerbit = Penerbit::where('id_penerbit', $id)->first();
        if (!$penerbit) {
            return response([
            'success' => false,
            'message' => 'Data tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $penerbit->fill($input);
            return response([
                'success' => true,
                'message' => 'Update berhasil',
                'data' => $penerbit,
            ],201);
        }
        
    }

    public function delete($id)
    {
        $penerbit = Penerbit::find($id)->delete();
        if ($penerbit){
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
