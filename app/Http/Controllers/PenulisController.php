<?php

namespace App\Http\Controllers;
use App\Models\Penulis;
use Illuminate\Http\Request;

class PenulisController extends Controller
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
        $penulis = Penulis::all();
        $count = $penulis->count();
        if ($count >= 1){
            return response([
                'success' => true,
                'message' => 'Data Penulis',
                'data' => $penulis
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Data Penulis Kosong',
                'data' => ''
            ],404);
        }
    }

    public function showId($id)
    {
        $penulis = Penulis::find($id);

        if($penulis){
            return response([
                'success' => true,
                'message' => 'Data ditemukan!',
                'data' => $penulis
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
        $nama_penulis = $request->input('nama_penulis');

        $cek_penulis = Penulis::where('nama_penulis',$nama_penulis)->first();
        if ($cek_penulis){
            return response([
                'Success' => false,
                'message' => 'Penulis sudah terdaftar'
            ],400);
        }else {
            $tambah = Penulis::create([
                'nama_penulis' => $nama_penulis,
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
        $penulis = Penulis::where('id_penulis', $id)->first();
        if (!$penulis) {
            return response([
            'success' => false,
            'message' => 'Data tidak ditemukan!',
            'data' => '',
            ],404);
        } else {
            $penulis->fill($input);
            return response([
                'success' => true,
                'message' => 'Update berhasil',
                'data' => $penulis,
            ],201);
        }
        
    }

    public function delete($id)
    {
        $penulis = Penulis::find($id)->delete();
        if ($penulis){
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
